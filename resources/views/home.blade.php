<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus Blog — Premium Tech Publication</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Newsreader:opsz,wght@6..72,700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.44.0/tabler-icons.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <style>

        /* CURSOR SPOTLIGHT */
        .cursor-dot { position: fixed; top: 0; left: 0; width: 7px; height: 7px; background: var(--indigo); border-radius: 50%; pointer-events: none; z-index: 10000; transform: translate(-50%, -50%); }
        .cursor-ring { position: fixed; top: 0; left: 0; width: 34px; height: 34px; border: 2px solid var(--indigo); border-radius: 50%; pointer-events: none; z-index: 10000; transform: translate(-50%, -50%); opacity: 0.5; }
        @media (hover: none) { .cursor-dot, .cursor-ring { display: none; } }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        body { background: #fff; color: #0f1115; overflow-x: hidden; }

        :root { --indigo: #4F46E5; --pad: clamp(24px, 8vw, 160px); }

        #progress { position: fixed; top: 0; left: 0; width: 0%; height: 3px; background: var(--indigo); z-index: 9999; }

        .blob { position: absolute; border-radius: 50%; opacity: 0.5; z-index: 0; pointer-events: none; }
        .blob1 { width: 400px; height: 400px; background: #EEF0FF; top: 40px; right: -120px; }
        .blob2 { width: 300px; height: 300px; background: #F0EDFF; top: 500px; left: -100px; }

        /* NAV */
        .logo-mark { width: 32px; height: 32px; background: var(--indigo); border-radius: 9px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; }

        /* MASTHEAD */
        .masthead { display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; padding: 28px var(--pad); background: #fff; }
        .masthead-left { display: flex; align-items: center; gap: 10px; justify-self: start; }
        .masthead-date { font-size: 13px; color: #444; font-weight: 500; }
        .masthead-brand { font-family: 'Newsreader', Georgia, serif; font-weight: 700; font-size: 48px; letter-spacing: -0.5px; color: #0f1115; text-decoration: none; line-height: 1; justify-self: center; }
        .masthead-right { display: flex; align-items: center; gap: 18px; justify-self: end; }
        .masthead-login { font-size: 13px; color: #555; font-weight: 500; text-decoration: none; }
        .masthead-cta { background: var(--indigo); color: #fff; font-size: 12px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 26px; border-radius: 4px; text-decoration: none; transition: opacity 0.2s; }
        .masthead-cta:hover { opacity: 0.88; }

        /* NEWS NAV BAR */
        .newsbar { display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; padding: 10px var(--pad); position: sticky; top: 0; z-index: 100; background: rgba(255,255,255,0.92); backdrop-filter: blur(12px); border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB; }
        .newsbar-archives { justify-self: start; background: #0f1115; color: #fff; font-size: 12.5px; font-weight: 600; padding: 10px 22px; border-radius: 4px; text-decoration: none; }
        .newsbar-links { display: flex; gap: 30px; justify-self: center; }
        .newsbar-links a { font-size: 13.5px; color: #222; font-weight: 600; text-decoration: none; transition: color 0.2s; }
        .newsbar-links a:hover, .newsbar-links a.active { color: var(--indigo); }
        .newsbar-social { display: flex; align-items: center; gap: 14px; justify-self: end; }
        .newsbar-social a { color: #333; font-size: 16px; text-decoration: none; display: flex; transition: color 0.2s; }
        .newsbar-social a:hover { color: var(--indigo); }

        /* LIVE WORLD NEWS TICKER */
        .ticker { display: flex; align-items: center; padding: 26px var(--pad) 0; position: relative; z-index: 6; }
        .ticker-badge { position: relative; width: 96px; height: 88px; background: linear-gradient(160deg, #E53935, #8E0E00); clip-path: polygon(25% 0, 75% 0, 100% 50%, 75% 100%, 25% 100%, 0 50%); display: flex; flex-direction: column; align-items: center; justify-content: center; color: #fff; font-weight: 800; z-index: 2; flex-shrink: 0; filter: drop-shadow(0 6px 14px rgba(183,28,28,0.35)); }
        .ticker-badge-dot { width: 7px; height: 7px; background: #fff; border-radius: 50%; margin-bottom: 6px; animation: tickerPulse 1.2s ease-in-out infinite; }
        @keyframes tickerPulse { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.3; transform: scale(0.7); } }
        .ticker-badge-line1 { font-size: 17px; letter-spacing: 1.5px; line-height: 1.1; }
        .ticker-badge-line2 { font-size: 9.5px; letter-spacing: 2.5px; }
        .ticker-main { flex: 1; margin-left: -20px; min-width: 0; }
        .ticker-headline-bar { position: relative; height: 46px; display: flex; align-items: center; padding: 0 90px 0 38px; background: linear-gradient(96deg, #8E0E00 0%, #C62828 45%, #E53935 72%, rgba(229,57,53,0) 99%); clip-path: polygon(0 0, calc(100% - 4px) 0, calc(100% - 26px) 100%, 0 100%); overflow: hidden; }
        .ticker-slash { position: absolute; top: -4px; bottom: -4px; width: 10px; background: rgba(255,255,255,0.9); transform: skewX(-24deg); }
        .ticker-slash-2 { width: 5px; opacity: 0.7; }
        .ticker-headline { color: #fff; font-size: 16px; font-weight: 800; letter-spacing: 0.2px; text-decoration: none; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block; }
        .ticker-headline:hover { text-decoration: underline; }
        .ticker-sub { position: relative; height: 30px; margin: 5px 60px 0 46px; background: linear-gradient(90deg, #E8E8E8, #F7F7F7 60%, rgba(247,247,247,0)); clip-path: polygon(10px 0, 100% 0, calc(100% - 14px) 100%, 0 100%); display: flex; align-items: center; overflow: hidden; }
        .ticker-sub::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 7px; background: #B71C1C; transform: skewX(-24deg); }
        .ticker-marquee-track { display: inline-flex; align-items: center; gap: 48px; white-space: nowrap; padding-left: 24px; animation: tickerScroll 60s linear infinite; will-change: transform; }
        .ticker-sub:hover .ticker-marquee-track { animation-play-state: paused; }
        @keyframes tickerScroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        .ticker-marquee-item { font-size: 12px; color: #444; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .ticker-marquee-item:hover { color: #B71C1C; }
        .ticker-src { color: #D32F2F; font-weight: 800; font-size: 9.5px; letter-spacing: 0.5px; text-transform: uppercase; }

        /* SEARCH */
        .search-trigger { background: none; border: none; padding: 4px; cursor: pointer; display: flex; align-items: center; font-size: 19px; color: #333; transition: color 0.2s; }
        .search-trigger:hover { color: var(--indigo); }
        .search-overlay { position: fixed; inset: 0; background: rgba(15,17,21,0.6); backdrop-filter: blur(4px); z-index: 10002; display: flex; align-items: flex-start; justify-content: center; padding: 100px 20px 20px; }
        .search-box { background: #fff; border-radius: 20px; max-width: 560px; width: 100%; box-shadow: 0 30px 80px rgba(0,0,0,0.3); overflow: hidden; }
        .search-input-wrap { display: flex; align-items: center; gap: 12px; padding: 18px 22px; border-bottom: 1px solid #F3F4F6; }
        .search-input-icon { font-size: 20px; color: #999; }
        .search-input { flex: 1; border: none; outline: none; font-size: 16px; color: #0f1115; font-family: inherit; background: transparent; }
        .search-input::placeholder { color: #bbb; }
        .search-close { background: #F3F4F6; border: none; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #666; font-size: 15px; }
        .search-close:hover { background: #E5E7EB; }
        .search-results { max-height: 400px; overflow-y: auto; }
        .search-result { display: block; padding: 16px 22px; text-decoration: none; border-bottom: 1px solid #F9FAFB; transition: background 0.15s; }
        .search-result:hover { background: #F9FAFB; }
        .search-result-cat { font-size: 10px; color: var(--indigo); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .search-result-title { font-size: 15px; font-weight: 700; color: #0f1115; margin-bottom: 4px; }
        .search-result-meta { font-size: 12px; color: #999; }
        .search-empty, .search-hint { padding: 28px 22px; text-align: center; color: #999; font-size: 14px; }

        /* HERO */
        /* HERO — NEWSPAPER FRONT PAGE */
        .paper { display: grid; grid-template-columns: 300px 1fr 320px; padding: 34px var(--pad) 56px; position: relative; z-index: 5; align-items: start; }
        .paper-left { padding-right: 26px; border-right: 1px solid #E5E7EB; }
        .paper-center { padding: 0 26px; }
        .paper-right { padding-left: 26px; border-left: 1px solid #E5E7EB; }
        .paper-subs { display: flex; align-items: center; justify-content: center; gap: 10px; border: 1px solid #0f1115; border-radius: 10px; padding: 14px; font-size: 17px; font-weight: 700; color: #0f1115; text-decoration: none; margin-bottom: 14px; transition: all 0.2s; }
        .paper-subs i { font-size: 22px; }
        .paper-subs:hover { background: #0f1115; color: #fff; }
        .paper-item { display: block; text-decoration: none; padding: 14px 0; border-bottom: 1px solid #F0F0F0; }
        .paper-item:last-child { border-bottom: none; }
        .paper-item-title { font-size: 15px; font-weight: 700; color: #0f1115; line-height: 1.4; }
        .paper-item:hover .paper-item-title { color: var(--indigo); }
        .paper-time { font-size: 11.5px; color: #999; margin-top: 5px; }
        .paper-excerpt { font-size: 13px; color: #555; line-height: 1.65; margin-top: 8px; }
        .paper-thumb-row { display: flex; gap: 12px; align-items: flex-start; }
        .paper-thumb { width: 84px; height: 60px; flex-shrink: 0; background-size: cover; background-position: center; border-radius: 4px; }
        .paper-hot { display: flex; align-items: center; justify-content: center; gap: 7px; color: #D32F2F; font-size: 13px; font-weight: 800; letter-spacing: 0.5px; margin-bottom: 16px; }
        .paper-hot i { font-size: 17px; }
        .paper-feature { display: block; position: relative; height: 380px; background-size: cover; background-position: center; text-decoration: none; overflow: hidden; }
        .paper-feature-overlay { position: absolute; inset: 0; display: flex; flex-direction: column; justify-content: flex-end; padding: 24px; background: linear-gradient(to top, rgba(0,0,0,0.75), transparent 55%); }
        .paper-feature-title { color: #fff; font-size: 24px; font-weight: 800; line-height: 1.25; }
        .paper-feature-date { color: rgba(255,255,255,0.85); font-size: 12.5px; margin-top: 8px; }
        .paper-center-story .paper-item-title { font-size: 17px; }
        .paper-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 32px; border-top: 1px solid #E5E7EB; }
        .paper-grid .paper-item-title { font-size: 14.5px; }
        .paper-rimg { width: 100%; height: 170px; background-size: cover; background-position: center; margin-bottom: 12px; }
        .paper-mini-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; padding-top: 18px; border-top: 1px solid #E5E7EB; margin-top: 6px; }
        .paper-mini { text-decoration: none; }
        .paper-mini-img { width: 100%; height: 74px; background-size: cover; background-position: center; margin-bottom: 8px; }
        .paper-mini-title { font-size: 12.5px; font-weight: 700; color: #0f1115; line-height: 1.4; }
        .paper-mini:hover .paper-mini-title { color: var(--indigo); }

        /* TRUST */
        .trust { background: #fff; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB; padding: 26px var(--pad); text-align: center; }
        .trust-label { font-size: 13px; color: #D32F2F; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 800; margin-bottom: 18px; }
        .trust-cats { display: flex; justify-content: center; gap: 44px; flex-wrap: wrap; }
        .trust-cat { display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 700; color: #444; }
        .trust-cat i { font-size: 18px; color: #555; }

        /* ANIMATED STATS */
        .stats-band { padding: 48px var(--pad); background: #fff; border-bottom: 1px solid #E5E7EB; position: relative; z-index: 5; }
        .stats-grid { display: grid; grid-template-columns: repeat(4,1fr); max-width: 1000px; margin: 0 auto; align-items: stretch; }
        .stat-box { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 16px; border-left: 1px solid #E5E7EB; min-height: 110px; }
        .stat-box:first-child { border-left: none; }
        .stat-value { display: flex; align-items: baseline; justify-content: center; gap: 2px; margin-bottom: 10px; }
        .stat-num { font-size: 42px; font-weight: 800; color: #0f1115; letter-spacing: -1.5px; line-height: 1; }
        .stat-plus { font-size: 30px; font-weight: 800; color: #0f1115; line-height: 1; }
        .stat-label { font-size: 11px; color: #888; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; }

        /* SECTION */
        .sec { padding: 56px var(--pad); position: relative; z-index: 5; }
        .sec-head { text-align: center; margin-bottom: 40px; }
        .sec-eyebrow { font-size: 13px; color: #D32F2F; font-weight: 800; letter-spacing: 0.5px; margin-bottom: 10px; }
        .sec-title { font-size: 30px; font-weight: 800; letter-spacing: -0.5px; color: #0f1115; }
        .sec-sub { font-size: 14px; color: #888; margin-top: 12px; }

        .stories-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 26px; }
        .story { background: #fff; border: 1px solid #E5E7EB; overflow: hidden; opacity: 0; transition: border-color 0.2s; }
        .story:hover { border-color: #0f1115; }
        .story-img { height: 220px; position: relative; overflow: hidden; }
        .story-img-bg { position: absolute; inset: 0; background-size: cover; background-position: center; will-change: transform; }
        .story-cat { position: absolute; top: 0; left: 0; background: #fff; color: #D32F2F; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; padding: 7px 14px; z-index: 2; }
        .story-body { padding: 20px 22px; }
        .story-title { font-size: 17px; font-weight: 700; line-height: 1.35; margin-bottom: 12px; letter-spacing: -0.3px; }
        .story-meta { display: flex; align-items: center; gap: 10px; font-size: 12px; color: #999; }
        .story-dot { width: 3px; height: 3px; background: #ccc; border-radius: 50%; }

        /* FEATURE BAND */
        .feature { background: #0f1115; margin: 0 0 56px; padding: 56px var(--pad); display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; position: relative; overflow: hidden; }
        .feature-blob { display: none; }
        .feature-eyebrow { font-size: 13px; color: #F87171; font-weight: 800; letter-spacing: 0.5px; margin-bottom: 16px; position: relative; }
        .feature-title { font-size: 32px; font-weight: 800; color: #fff; line-height: 1.15; letter-spacing: -0.8px; margin-bottom: 16px; position: relative; }
        .feature-desc { font-size: 14px; color: rgba(255,255,255,0.8); line-height: 1.7; margin-bottom: 24px; position: relative; }
        .feature-list { display: flex; flex-direction: column; gap: 12px; position: relative; }
        .feature-item { display: flex; align-items: center; gap: 12px; font-size: 13px; color: #fff; }
        .feature-item i { width: 24px; height: 24px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 13px; }
        .feature-imgs { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; position: relative; }
        .feature-img { height: 160px; background-size: cover; background-position: center; }

        /* SECTION HEADER — label with black bar on a hairline rule */
        .dn-head { text-align: center; border-bottom: 1px solid #E5E7EB; margin-bottom: 36px; }
        .dn-head-label { display: inline-block; font-size: 15px; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase; color: #0f1115; padding-bottom: 12px; border-bottom: 3px solid #0f1115; margin-bottom: -1px; }

        /* MOST READ THIS WEEK — divided card columns */
        .mostread-grid { display: grid; grid-template-columns: repeat(4, 1fr); }
        .mr-card { display: block; text-decoration: none; padding: 0 24px; border-left: 1px solid #E5E7EB; }
        .mr-card:first-child { border-left: none; padding-left: 0; }
        .mr-card:last-child { padding-right: 0; }
        .mr-img { width: 100%; height: 170px; background-size: cover; background-position: center; margin-bottom: 16px; }
        .mr-title { font-size: 16.5px; font-weight: 700; color: #0f1115; line-height: 1.35; margin-bottom: 8px; transition: color 0.15s; }
        .mr-card:hover .mr-title { color: #D32F2F; }
        .mr-date { font-size: 10.5px; color: #999; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase; margin-bottom: 10px; }
        .mr-excerpt { font-size: 13px; color: #555; line-height: 1.65; }

        /* AUTHOR */
        .author-card { display: flex; align-items: center; gap: 36px; max-width: 820px; margin: 0 auto; background: #fff; border: 1px solid #E5E7EB; padding: 36px; }
        .author-av { width: 110px; height: 110px; background: #0f1115; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 44px; font-weight: 800; flex-shrink: 0; }
        .author-label { font-size: 11px; letter-spacing: 1px; text-transform: uppercase; color: #D32F2F; font-weight: 800; margin-bottom: 10px; }
        .author-name { font-size: 28px; font-weight: 800; margin-bottom: 10px; letter-spacing: -0.5px; }
        .author-bio { font-size: 13px; color: #777; line-height: 1.7; margin-bottom: 18px; }
        .author-stats { display: flex; gap: 32px; }
        .author-stat-n { font-size: 22px; font-weight: 800; color: #0f1115; }
        .author-stat-l { font-size: 10px; color: #aaa; letter-spacing: 0.5px; text-transform: uppercase; }

        /* ARTICLE FILTER (LIVEWIRE) */
        .filter-btns { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; margin-bottom: 36px; }
        .filter-btn { background: #fff; border: 1px solid #E5E7EB; padding: 10px 22px; font-size: 13px; font-weight: 600; color: #555; cursor: pointer; transition: all 0.2s; font-family: 'Plus Jakarta Sans', sans-serif; }
        .filter-btn:hover { border-color: #0f1115; color: #0f1115; }
        .filter-btn.active { background: #0f1115; border-color: #0f1115; color: #fff; }
        .filter-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; max-width: 1000px; margin: 0 auto; }
        .filter-card { background: #fff; border: 1px solid #E5E7EB; padding: 24px; cursor: pointer; transition: border-color 0.2s; }
        .filter-card:hover { border-color: #0f1115; }
        .filter-card-cat { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px; }
        .filter-card-title { font-size: 17px; font-weight: 700; line-height: 1.4; letter-spacing: -0.3px; margin-bottom: 14px; color: #0f1115; }
        .filter-card-meta { font-size: 12px; color: #999; }
        .filter-empty { grid-column: 1 / -1; text-align: center; padding: 48px; color: #999; font-size: 14px; }

        @media (max-width: 768px) {
            .filter-grid { grid-template-columns: 1fr; }
        }

        /* NEWSLETTER */
        .nl { background: #0f1115; margin: 0; padding: 64px var(--pad); text-align: center; position: relative; overflow: hidden; border-bottom: 1px solid rgba(255,255,255,0.12); }
        .nl-blob { display: none; }
        .nl-title { font-size: 34px; font-weight: 800; color: #fff; letter-spacing: -1px; margin-bottom: 12px; position: relative; }
        .nl-sub { font-size: 14px; color: rgba(255,255,255,0.5); margin-bottom: 30px; position: relative; }
        .nl-form { display: flex; gap: 10px; justify-content: center; position: relative; }
        .nl-input { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); padding: 15px 24px; font-size: 13px; color: #fff; width: 300px; outline: none; }
        .nl-input:focus { border-color: #fff; }
        .nl-btn { background: #fff; color: #0f1115; font-size: 13px; font-weight: 700; padding: 15px 32px; border: none; cursor: pointer; transition: opacity 0.2s; }
        .nl-btn:hover { opacity: 0.85; }

        /* FOOTER */
        .footer { background: #0f1115; padding: 56px var(--pad) 28px; }
        .footer-top { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; padding-bottom: 40px; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .footer-brand .footer-logo { display: flex; align-items: center; gap: 10px; font-size: 18px; font-weight: 700; color: #fff; margin-bottom: 16px; }
        .footer-tagline { font-size: 13px; color: rgba(255,255,255,0.45); line-height: 1.7; max-width: 280px; margin-bottom: 22px; }
        .footer-social { display: flex; gap: 10px; }
        .social-ic { width: 38px; height: 38px; background: rgba(255,255,255,0.06); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.6); font-size: 17px; text-decoration: none; transition: all 0.2s; }
        .social-ic:hover { background: #fff; color: #0f1115; }
        .footer-col-title { font-size: 13px; font-weight: 700; color: #fff; margin-bottom: 18px; }
        .footer-col a { display: block; font-size: 13px; color: rgba(255,255,255,0.45); text-decoration: none; margin-bottom: 12px; transition: color 0.2s; }
        .footer-col a:hover { color: var(--indigo); }
        .footer-bottom { display: flex; align-items: center; justify-content: space-between; padding-top: 24px; }
        .footer-copy { font-size: 12px; color: rgba(255,255,255,0.3); }
        .footer-legal { display: flex; gap: 24px; }
        .footer-legal a { font-size: 12px; color: rgba(255,255,255,0.3); text-decoration: none; }
        .footer-legal a:hover { color: var(--indigo); }

        /* BACK TO TOP */
        .back-to-top { position: fixed; bottom: 30px; right: 30px; width: 52px; height: 52px; border: none; background: var(--indigo); border-radius: 50%; cursor: pointer; z-index: 9998; display: flex; align-items: center; justify-content: center; color: #fff; box-shadow: 0 8px 24px rgba(79,70,229,0.35); opacity: 0; visibility: hidden; transform: translateY(20px) scale(0.8); transition: opacity 0.3s, visibility 0.3s, transform 0.3s, box-shadow 0.3s; }
        .back-to-top.show { opacity: 1; visibility: visible; transform: translateY(0) scale(1); }
        .back-to-top:hover { transform: translateY(-3px) scale(1.05); box-shadow: 0 12px 32px rgba(79,70,229,0.5); }
        .btt-ring { position: absolute; top: -1px; left: -1px; transform: rotate(-90deg); pointer-events: none; }
        .btt-ring-bg { fill: none; stroke: rgba(255,255,255,0.25); stroke-width: 2.5; }
        .btt-ring-fill { fill: none; stroke: #fff; stroke-width: 2.5; stroke-linecap: round; stroke-dasharray: 150.8; stroke-dashoffset: 150.8; transition: stroke-dashoffset 0.1s linear; }
        .btt-arrow { position: relative; z-index: 1; }dth: 3; stroke-linecap: round; stroke-dasharray: 144.5; stroke-dashoffset: 144.5; transition: stroke-dashoffset 0.1s linear; }
        .back-to-top i { position: relative; z-index: 1; }

        /* NEWSLETTER POPUP */
        .popup-overlay { position: fixed; inset: 0; background: rgba(15,17,21,0.6); backdrop-filter: blur(4px); z-index: 10001; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: opacity 0.4s, visibility 0.4s; padding: 20px; }
        .popup-overlay.show { opacity: 1; visibility: visible; }
        .popup { background: #fff; border-radius: 28px; padding: 48px 40px; max-width: 440px; width: 100%; text-align: center; position: relative; transform: scale(0.9) translateY(20px); transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1); box-shadow: 0 30px 80px rgba(0,0,0,0.3); }
        .popup-overlay.show .popup { transform: scale(1) translateY(0); }
        .popup-close { position: absolute; top: 20px; right: 20px; width: 36px; height: 36px; border: none; background: #F3F4F6; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #666; transition: background 0.2s, color 0.2s; }
        .popup-close:hover { background: #E5E7EB; color: #0f1115; }
        .popup-icon { width: 64px; height: 64px; background: #EEF0FF; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 30px; color: var(--indigo); margin: 0 auto 22px; }
        .popup-title { font-size: 26px; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 12px; color: #0f1115; }
        .popup-text { font-size: 14px; color: #777; line-height: 1.7; margin-bottom: 28px; }
        .popup-form { display: flex; flex-direction: column; gap: 10px; margin-bottom: 16px; }
        .popup-input { background: #F9FAFB; border: 1.5px solid #E5E7EB; border-radius: 26px; padding: 14px 22px; font-size: 14px; color: #0f1115; outline: none; text-align: center; transition: border-color 0.2s; }
        .popup-input:focus { border-color: var(--indigo); }
        .popup-btn { background: var(--indigo); color: #fff; font-size: 14px; font-weight: 600; padding: 14px; border-radius: 26px; border: none; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; }
        .popup-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(79,70,229,0.3); }
        .popup-note { font-size: 11px; color: #aaa; }

        @media (max-width: 768px) {
            :root { --pad: 20px; }
            .paper { grid-template-columns: 1fr; padding: 24px 20px 40px; }
            .paper-left, .paper-right { border: none; padding: 0; }
            .paper-center { padding: 0; margin-bottom: 24px; }
            .paper-left { order: 2; margin-top: 24px; }
            .paper-center { order: 1; }
            .paper-right { order: 3; }
            .paper-feature { height: 260px; }
            .paper-feature-title { font-size: 20px; }
            .ticker { padding-top: 16px; }
            .ticker-badge { width: 72px; height: 66px; }
            .ticker-badge-line1 { font-size: 13px; }
            .ticker-headline-bar { height: 40px; padding: 0 44px 0 28px; }
            .ticker-headline { font-size: 12.5px; }
            .ticker-slash { display: none; }
            .ticker-sub { margin: 4px 20px 0 34px; }
            .stats-grid { grid-template-columns: repeat(2,1fr); }
            .stories-grid { grid-template-columns: 1fr; }
            .sec-title { font-size: 26px; }
            .feature { grid-template-columns: 1fr; padding: 32px; margin: 0 20px 48px; }
            .trend-img, .trend-views { display: none; }
            .author-card { flex-direction: column; text-align: center; padding: 28px; }
            .author-stats { justify-content: center; }
            .cats-grid { grid-template-columns: 1fr; }
            .nl { padding: 36px 24px; margin: 0 20px 48px; }
            .nl-form { flex-direction: column; }
            .nl-input { width: 100%; }
            .footer-top { grid-template-columns: 1fr 1fr; gap: 32px; }
            .footer-bottom { flex-direction: column; gap: 14px; text-align: center; }
            .footer-legal { justify-content: center; }
            .newsbar-links { display: none; }
            .mostread-grid { grid-template-columns: 1fr; row-gap: 32px; }
            .mr-card { border-left: none; padding: 0; }
            .masthead { padding: 18px 20px; }
            .masthead-brand { font-size: 36px; }
            .masthead-date, .masthead-login { display: none; }
            .masthead-cta { padding: 10px 18px; }
            .trust-cats { gap: 20px; }
        }
    </style>
</head>
<body>

<div class="cursor-dot" id="cursorDot"></div>
<div class="cursor-ring" id="cursorRing"></div>

<div id="progress"></div>
<div class="blob blob1"></div>
<div class="blob blob2"></div>

<header class="masthead">
    <div class="masthead-left">
        <livewire:search-bar />
        <span class="masthead-date">{{ now()->format('l, F j') }}</span>
    </div>
    <a href="{{ route('home') }}" class="masthead-brand">Nexus Blog</a>
    <div class="masthead-right">
        <a href="{{ route('login') }}" class="masthead-login">Login</a>
        <a href="{{ route('register') }}" class="masthead-cta">Subscribe</a>
    </div>
</header>

<nav class="newsbar" id="navbar">
    <a href="#explore-sec" class="newsbar-archives">Archives</a>
    <div class="newsbar-links">
        <a href="{{ route('home') }}" class="active">Home</a>
        <a href="#">AI & ML</a>
        <a href="#">Space</a>
        <a href="#">Biotech</a>
        <a href="#">About</a>
    </div>
    <div class="newsbar-social">
        <a href="#" aria-label="Facebook"><i class="ti ti-brand-facebook"></i></a>
        <a href="#" aria-label="X"><i class="ti ti-brand-x"></i></a>
        <a href="#" aria-label="YouTube"><i class="ti ti-brand-youtube"></i></a>
        <a href="#" aria-label="Email"><i class="ti ti-mail"></i></a>
    </div>
</nav>

{{-- LIVE WORLD NEWS TICKER --}}
@if($newsItems->isNotEmpty())
<div class="ticker">
    <div class="ticker-badge">
        <span class="ticker-badge-dot"></span>
        <span class="ticker-badge-line1">LIVE</span>
        <span class="ticker-badge-line2">WORLD</span>
    </div>
    <div class="ticker-main">
        <div class="ticker-headline-bar">
            <a href="{{ $newsItems[0]->url }}" target="_blank" rel="noopener" class="ticker-headline" id="tickerHeadline">{{ $newsItems[0]->title }}</a>
            <div class="ticker-slash" style="right: 70px;"></div>
            <div class="ticker-slash ticker-slash-2" style="right: 54px;"></div>
        </div>
        <div class="ticker-sub">
            <div class="ticker-marquee-track">
                @foreach($newsItems->concat($newsItems) as $news)
                <a href="{{ $news->url }}" target="_blank" rel="noopener" class="ticker-marquee-item">
                    <span class="ticker-src">{{ $news->source }}</span>{{ $news->title }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

{{-- HERO — NEWSPAPER FRONT PAGE --}}
@php
    $heroImgs = [
        'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=900&q=80',
        'https://images.unsplash.com/photo-1518770660439-4636190af475?w=500&q=80',
        'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=500&q=80',
        'https://images.unsplash.com/photo-1446776811953-b23d57bd21aa?w=600&q=80',
        'https://images.unsplash.com/photo-1576086213369-97a306d36557?w=500&q=80',
        'https://images.unsplash.com/photo-1509391366360-2e959784a276?w=500&q=80',
    ];
    $heroImg = fn ($p) => $p->featured_image ?: $heroImgs[($p->id - 1) % count($heroImgs)];
    $paperFeature = $heroPosts->first();
    $paperSide = $heroPosts->slice(1)->values();
@endphp
@if($paperFeature)
<section class="paper">
    {{-- LEFT COLUMN --}}
    <div class="paper-left">
        <a href="{{ route('register') }}" class="paper-subs"><i class="ti ti-news"></i> Subscription Plans</a>
        @foreach($paperSide->take(5) as $i => $p)
        <a href="{{ route('posts.show', $p) }}" class="paper-item">
            @if($i === 1)
            <div class="paper-thumb-row">
                <div class="paper-thumb" style="background-image:url('{{ $heroImg($p) }}')"></div>
                <div>
                    <div class="paper-item-title">{{ $p->title }}</div>
                    <div class="paper-time">{{ $p->published_at->diffForHumans() }}</div>
                </div>
            </div>
            @else
            <div class="paper-item-title">{{ $p->title }}</div>
            <div class="paper-time">{{ $p->published_at->diffForHumans() }}</div>
            @endif
            @if($i < 2)
            <p class="paper-excerpt">{{ Str::limit($p->excerpt, 160) }}</p>
            @endif
        </a>
        @endforeach
    </div>

    {{-- CENTER COLUMN --}}
    <div class="paper-center">
        <div class="paper-hot"><i class="ti ti-flame"></i> HOT STORIES</div>
        <a href="{{ route('posts.show', $paperFeature) }}" class="paper-feature" style="background-image:url('{{ $heroImg($paperFeature) }}')">
            <div class="paper-feature-overlay">
                <div class="paper-feature-title">{{ $paperFeature->title }}</div>
                <div class="paper-feature-date">{{ $paperFeature->published_at->format('F j, Y') }}</div>
            </div>
        </a>
        @if($paperSide->isNotEmpty())
        <a href="{{ route('posts.show', $paperSide[0]) }}" class="paper-item paper-center-story">
            <div class="paper-item-title">{{ $paperSide[0]->title }}</div>
            <div class="paper-time">{{ $paperSide[0]->published_at->diffForHumans() }}</div>
            <p class="paper-excerpt">{{ Str::limit($paperSide[0]->excerpt, 220) }}</p>
        </a>
        @endif
        <div class="paper-grid">
            @foreach($paperSide->skip(1)->take(6) as $p)
            <a href="{{ route('posts.show', $p) }}" class="paper-item">
                <div class="paper-item-title">{{ $p->title }}</div>
                <div class="paper-time">{{ $p->published_at->format('F j, Y') }}</div>
            </a>
            @endforeach
        </div>
    </div>

    {{-- RIGHT COLUMN --}}
    <div class="paper-right">
        @php $paperRight = $paperSide->get(2) ?? $paperFeature; @endphp
        <a href="{{ route('posts.show', $paperRight) }}" class="paper-item">
            <div class="paper-rimg" style="background-image:url('{{ $heroImg($paperRight) }}')"></div>
            <div class="paper-item-title">{{ $paperRight->title }}</div>
            <div class="paper-time" style="text-transform:uppercase;">{{ $paperRight->published_at->diffForHumans() }}</div>
            <p class="paper-excerpt" style="text-align:justify;">{{ Str::limit($paperRight->excerpt, 200) }}</p>
        </a>
        <div class="paper-mini-grid">
            @foreach($paperSide->skip(3)->take(4) as $p)
            <a href="{{ route('posts.show', $p) }}" class="paper-mini">
                <div class="paper-mini-img" style="background-image:url('{{ $heroImg($p) }}')"></div>
                <div class="paper-mini-title">{{ $p->title }}</div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- TRUST --}}
<div class="trust">
    <div class="trust-label">Covering the world's leading tech</div>
    <div class="trust-cats">
        <div class="trust-cat"><i class="ti ti-brain"></i>AI & ML</div>
        <div class="trust-cat"><i class="ti ti-shield"></i>Cybersecurity</div>
        <div class="trust-cat"><i class="ti ti-rocket"></i>Space</div>
        <div class="trust-cat"><i class="ti ti-dna"></i>Biotech</div>
        <div class="trust-cat"><i class="ti ti-leaf"></i>Green Tech</div>
    </div>
</div>

{{-- ANIMATED STATS --}}
<section class="stats-band" id="stats-band">
    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-value"><span class="stat-num" data-count="128">0</span><span class="stat-plus">+</span></div>
            <div class="stat-label">Articles Published</div>
        </div>
        <div class="stat-box">
            <div class="stat-value"><span class="stat-num" data-count="24">0</span><span class="stat-plus">K</span></div>
            <div class="stat-label">Monthly Readers</div>
        </div>

        <div class="stat-box">
            <div class="stat-value"><span class="stat-num" data-count="{{ $categories->count() }}">0</span></div>
            <div class="stat-label">Categories</div>
        </div>
        <div class="stat-box">
            <div class="stat-value"><span class="stat-num" data-count="98">0</span><span class="stat-plus">%</span></div>
            <div class="stat-label">Reader Satisfaction</div>
        </div>
    </div>
</section>

{{-- LATEST STORIES --}}
<section class="sec" id="stories-sec">
    <div class="sec-head">
        <div class="sec-eyebrow">LATEST STORIES</div>
        <div class="sec-title">What's happening in tech</div>
        <div class="sec-sub">Fresh insights and breaking stories from the world of technology</div>
    </div>
    <div class="stories-grid">
        @php
            $imgs = [
                'https://images.unsplash.com/photo-1518770660439-4636190af475?w=500&q=80',
                'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=500&q=80',
                'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=500&q=80',
                'https://images.unsplash.com/photo-1497436072909-60f360e1d4b1?w=500&q=80',
            ];
        @endphp
        @foreach($latestPosts->take(3) as $index => $post)
        <div class="story">
            <div class="story-img">
                <div class="story-img-bg" style="background-image:url('{{ $imgs[$index % 4] }}');"></div>
                <div class="story-cat">{{ $post->category->name ?? 'Tech' }}</div>
            </div>
            <div class="story-body">
                <div class="story-title">{{ $post->title }}</div>
                <div class="story-meta">
                    <span>{{ $post->reading_time }} min read</span>
                    <div class="story-dot"></div>
                    <span>{{ number_format($post->views) }} views</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- FEATURE BAND --}}
<div class="feature" id="feature-sec">
    <div class="feature-blob"></div>
    <div>
        <div class="feature-eyebrow">ABOUT NEXUS</div>
        <div class="feature-title">Where ideas grow into meaningful stories</div>
        <div class="feature-desc">We craft in-depth technology journalism led by expert writers, designed to inspire curiosity and understanding.</div>
        <div class="feature-list">
            <div class="feature-item"><i class="ti ti-check"></i>AI-powered article summaries</div>
            <div class="feature-item"><i class="ti ti-check"></i>Expert writers, deep knowledge</div>
            <div class="feature-item"><i class="ti ti-check"></i>100% ad-free, open access</div>
        </div>
    </div>
    <div class="feature-imgs">
        <div class="feature-img" style="grid-column:span 2;height:220px;background-image:url('https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=600&q=80');"></div>
        <div class="feature-img" style="background-image:url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=400&q=80');"></div>
        <div class="feature-img" style="background-image:url('https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&q=80');"></div>
    </div>
</div>

{{-- AUTHOR --}}
@if($topAuthor)
<section class="sec" id="author-sec" style="padding-top:0;">
    <div class="sec-head">
        <div class="sec-eyebrow">MEET THE TEAM</div>
        <div class="sec-title">Author spotlight</div>
    </div>
    <div class="author-card">
        <div class="author-av">{{ strtoupper(substr($topAuthor->name, 0, 1)) }}</div>
        <div>
            <div class="author-label">Top Writer</div>
            <div class="author-name">{{ $topAuthor->name }}</div>
            <div class="author-bio">A passionate technology writer covering AI, innovation, and the future of computing. Bringing complex topics to life with clarity and depth.</div>
            <div class="author-stats">
                <div><div class="author-stat-n">{{ $topAuthor->posts_count }}</div><div class="author-stat-l">Articles</div></div>
                <div><div class="author-stat-n">52K</div><div class="author-stat-l">Total Views</div></div>
                <div><div class="author-stat-n">4.9</div><div class="author-stat-l">Rating</div></div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- EXPLORE ARTICLES (LIVEWIRE FILTER) --}}
<section class="sec" id="explore-sec" style="padding-top:0;">
    <div class="sec-head">
        <div class="sec-eyebrow">EXPLORE</div>
        <div class="sec-title">Browse all articles</div>
        <div class="sec-sub">Filter by category to find exactly what interests you</div>
    </div>
    <livewire:article-filter />
</section>

{{-- MOST READ THIS WEEK --}}
<section class="sec" id="trend-sec" style="padding-top:0;">
    <div class="dn-head"><span class="dn-head-label">Most Read This Week</span></div>
    <div class="mostread-grid">
        @php
            $trendImgs = [
                'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=400&q=80',
                'https://images.unsplash.com/photo-1446776877081-d282a0f896e2?w=400&q=80',
                'https://images.unsplash.com/photo-1509391366360-2e959784a276?w=400&q=80',
                'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=400&q=80',
            ];
        @endphp
        @foreach($trendingPosts as $index => $post)
        <a href="{{ route('posts.show', $post) }}" class="mr-card trend-row">
            <div class="mr-img" style="background-image:url('{{ $trendImgs[$index % 4] }}');"></div>
            <div class="mr-title">{{ $post->title }}</div>
            <div class="mr-date">{{ ($post->published_at ?? $post->created_at)->format('F j, Y') }}</div>
            <p class="mr-excerpt">{{ Str::limit($post->excerpt, 130) }}</p>
        </a>
        @endforeach
    </div>
</section>

{{-- NEWSLETTER --}}
<div class="nl" id="nl-sec">
    <div class="nl-blob"></div>
    <div class="nl-title">Join 24,000 readers</div>
    <div class="nl-sub">The best tech stories delivered every morning. No spam, ever.</div>
    <div class="nl-form">
        <input class="nl-input" type="email" placeholder="your@email.com">
        <button class="nl-btn">Subscribe Free</button>
    </div>
</div>

{{-- FOOTER --}}
<footer class="footer">
    <div class="footer-top">
        <div class="footer-brand">
            <div class="footer-logo"><div class="logo-mark"><i class="ti ti-bolt"></i></div>Nexus Blog</div>
            <p class="footer-tagline">Premium technology journalism for curious minds. Covering AI, innovation, and the breakthroughs shaping our future.</p>
            <div class="footer-social">
                <a href="#" class="social-ic"><i class="ti ti-brand-x"></i></a>
                <a href="#" class="social-ic"><i class="ti ti-brand-linkedin"></i></a>
                <a href="#" class="social-ic"><i class="ti ti-brand-github"></i></a>
                <a href="#" class="social-ic"><i class="ti ti-rss"></i></a>
            </div>
        </div>
        <div class="footer-col">
            <div class="footer-col-title">Categories</div>
            <a href="#">AI & Machine Learning</a>
            <a href="#">Cybersecurity</a>
            <a href="#">Space Technology</a>
            <a href="#">Biotech & Health</a>
            <a href="#">Green Technology</a>
        </div>
        <div class="footer-col">
            <div class="footer-col-title">Company</div>
            <a href="#">About Us</a>
            <a href="#">Our Writers</a>
            <a href="#">Careers</a>
            <a href="#">Contact</a>
            <a href="#">Press Kit</a>
        </div>
        <div class="footer-col">
            <div class="footer-col-title">Resources</div>
            <a href="#">Newsletter</a>
            <a href="#">RSS Feed</a>
            <a href="#">API Access</a>
            <a href="#">Sitemap</a>
            <a href="#">Help Center</a>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-copy">© {{ date('Y') }} Nexus Blog. All rights reserved.</div>
        <div class="footer-legal">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Cookies</a>
        </div>
    </div>

</footer>

{{-- NEWSLETTER POPUP --}}
<div class="popup-overlay" id="popupOverlay">
    <div class="popup" id="popup">
        <button class="popup-close" id="popupClose" aria-label="Close">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <div class="popup-icon"><i class="ti ti-mail"></i></div>
        <div class="popup-title">Don't miss a story</div>
        <div class="popup-text">Join 24,000 readers getting the best tech stories delivered every morning. No spam, ever.</div>
        <div class="popup-form">
            <input type="email" class="popup-input" placeholder="your@email.com">
            <button class="popup-btn">Subscribe Free →</button>
        </div>
        <div class="popup-note">Unsubscribe anytime. We respect your privacy.</div>
    </div>
</div>

{{-- BACK TO TOP --}}
<button id="backToTop" class="back-to-top" aria-label="Back to top">
    <svg class="btt-ring" width="52" height="52" viewBox="0 0 52 52">
        <circle class="btt-ring-bg" cx="26" cy="26" r="24" />
        <circle class="btt-ring-fill" cx="26" cy="26" r="24" />
    </svg>
    <svg class="btt-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="19" x2="12" y2="5"></line>
        <polyline points="5 12 12 5 19 12"></polyline>
    </svg>
</button>

<script>
gsap.registerPlugin(ScrollTrigger);

// Progress bar
window.addEventListener('scroll', () => {
    const pct = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
    document.getElementById('progress').style.width = pct + '%';
});

// Hero entrance
gsap.from('.paper-center', { opacity: 0, y: 24, duration: 0.7, ease: 'power3.out', delay: 0.1 });
gsap.from('.paper-left', { opacity: 0, y: 24, duration: 0.7, ease: 'power3.out', delay: 0.25 });
gsap.from('.paper-right', { opacity: 0, y: 24, duration: 0.7, ease: 'power3.out', delay: 0.4 });

// Live world news ticker — slide in, then rotate headlines every 5s
const tickerHeadline = document.getElementById('tickerHeadline');
if (tickerHeadline) {
    const tickerItems = @json($newsItems->map(fn ($n) => ['title' => $n->title, 'url' => $n->url])->values());
    let tickerIdx = 0;
    gsap.from('.ticker', { opacity: 0, y: -16, duration: 0.6, ease: 'power2.out' });
    setInterval(() => {
        gsap.to(tickerHeadline, { y: -24, opacity: 0, duration: 0.35, ease: 'power2.in', onComplete: () => {
            tickerIdx = (tickerIdx + 1) % tickerItems.length;
            tickerHeadline.textContent = tickerItems[tickerIdx].title;
            tickerHeadline.href = tickerItems[tickerIdx].url;
            gsap.fromTo(tickerHeadline, { y: 24, opacity: 0 }, { y: 0, opacity: 1, duration: 0.4, ease: 'power2.out' });
        }});
    }, 5000);
}

// Trust bar
gsap.from('.trust-cat', { opacity: 0, y: 15, duration: 0.5, stagger: 0.08, ease: 'power2.out',
    scrollTrigger: { trigger: '.trust', start: 'top 90%' } });

// ANIMATED STATS COUNTER
ScrollTrigger.create({
    trigger: '#stats-band',
    start: 'top 80%',
    once: true,
    onEnter: () => {
        document.querySelectorAll('.stat-num').forEach(el => {
            const target = parseInt(el.dataset.count);
            gsap.to(el, {
                innerText: target,
                duration: 2,
                snap: { innerText: 1 },
                ease: 'power2.out'
            });
        });
        gsap.from('.stat-box', { opacity: 0, y: 30, duration: 0.6, stagger: 0.1, ease: 'power2.out', clearProps: 'transform' });
    }
});

// NEWSLETTER POPUP
const popupOverlay = document.getElementById('popupOverlay');
const popupClose = document.getElementById('popupClose');

function showPopup() {
    // Only show once per browser session
    if (!sessionStorage.getItem('nexusPopupShown')) {
        popupOverlay.classList.add('show');
        sessionStorage.setItem('nexusPopupShown', 'true');
    }
}

function hidePopup() {
    popupOverlay.classList.remove('show');
}

// Show after 5 seconds
setTimeout(showPopup, 5000);

// Close on X button
popupClose.addEventListener('click', hidePopup);

// Close when clicking the dark background
popupOverlay.addEventListener('click', (e) => {
    if (e.target === popupOverlay) hidePopup();
});

// Close on Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') hidePopup();
});

// Stories
gsap.set('.story', { opacity: 0, y: 50 });
ScrollTrigger.create({ trigger: '#stories-sec', start: 'top 78%',
    onEnter: () => gsap.to('.story', { opacity: 1, y: 0, duration: 0.7, stagger: 0.15, ease: 'power3.out' }) });

// Story image zoom on hover
document.querySelectorAll('.story').forEach(s => {
    const img = s.querySelector('.story-img-bg');
    s.addEventListener('mouseenter', () => gsap.to(img, { scale: 1.08, duration: 0.5, ease: 'power2.out' }));
    s.addEventListener('mouseleave', () => gsap.to(img, { scale: 1, duration: 0.5, ease: 'power2.out' }));
});

// Feature band
gsap.from('.feature', { opacity: 0, scale: 0.96, duration: 0.8, ease: 'power3.out',
    scrollTrigger: { trigger: '#feature-sec', start: 'top 80%' } });
gsap.from('.feature-item', { opacity: 0, x: -20, duration: 0.5, stagger: 0.1, ease: 'power2.out',
    scrollTrigger: { trigger: '#feature-sec', start: 'top 70%' } });

// Trending rows
gsap.set('.trend-row', { opacity: 0, y: 24 });
ScrollTrigger.create({ trigger: '#trend-sec', start: 'top 80%',
    onEnter: () => gsap.to('.trend-row', { opacity: 1, y: 0, duration: 0.5, stagger: 0.1, ease: 'power2.out' }) });

// Author
gsap.from('.author-card', { opacity: 0, y: 40, duration: 0.8, ease: 'power3.out',
    scrollTrigger: { trigger: '#author-sec', start: 'top 82%' } });

// Tags

// Categories

// Newsletter
gsap.from('.nl', { opacity: 0, scale: 0.96, duration: 0.8, ease: 'power3.out',
    scrollTrigger: { trigger: '#nl-sec', start: 'top 85%' } });

// Nav shadow
window.addEventListener('scroll', () => {
    document.getElementById('navbar').style.boxShadow = window.scrollY > 30 ? '0 4px 30px rgba(0,0,0,0.06)' : 'none';
});

// BACK TO TOP BUTTON
const backToTop = document.getElementById('backToTop');
const bttFill = document.querySelector('.btt-ring-fill');
const bttCircumference = 150.8;

window.addEventListener('scroll', () => {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const scrollPct = scrollTop / docHeight;

    // Fill the ring based on scroll progress
    bttFill.style.strokeDashoffset = bttCircumference - (bttCircumference * scrollPct);

    // Show button after scrolling 400px
    if (scrollTop > 400) {
        backToTop.classList.add('show');
    } else {
        backToTop.classList.remove('show');
    }
});

// CUSTOM CURSOR
const cursorDot = document.getElementById('cursorDot');
const cursorRing = document.getElementById('cursorRing');

window.addEventListener('mousemove', (e) => {
    // Dot follows instantly
    gsap.set(cursorDot, { left: e.clientX, top: e.clientY });
    // Ring trails smoothly
    gsap.to(cursorRing, { left: e.clientX, top: e.clientY, duration: 0.4, ease: 'power2.out' });
});

// Ring grows over clickable elements
document.querySelectorAll('a, button, .story, .trend-row').forEach(el => {
    el.addEventListener('mouseenter', () => gsap.to(cursorRing, { scale: 1.6, opacity: 0.3, duration: 0.3 }));
    el.addEventListener('mouseleave', () => gsap.to(cursorRing, { scale: 1, opacity: 0.5, duration: 0.3 }));
});

// Smooth scroll to top on click
backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>

</body>
</html>
