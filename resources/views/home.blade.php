<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS — Premium Tech Publication</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/2.47.0/iconfont/tabler-icons.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <style>

        /* CURSOR SPOTLIGHT */
        .cursor-dot { position: fixed; top: 0; left: 0; width: 7px; height: 7px; background: var(--indigo); border-radius: 50%; pointer-events: none; z-index: 10000; transform: translate(-50%, -50%); }
        .cursor-ring { position: fixed; top: 0; left: 0; width: 34px; height: 34px; border: 2px solid var(--indigo); border-radius: 50%; pointer-events: none; z-index: 10000; transform: translate(-50%, -50%); opacity: 0.5; }
        @media (hover: none) { .cursor-dot, .cursor-ring { display: none; } }
        
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        body { background: #fff; color: #0f1115; overflow-x: hidden; }

        :root { --indigo: #4F46E5; --pad: 80px; }

        #progress { position: fixed; top: 0; left: 0; width: 0%; height: 3px; background: var(--indigo); z-index: 9999; }

        .blob { position: absolute; border-radius: 50%; opacity: 0.5; z-index: 0; pointer-events: none; }
        .blob1 { width: 400px; height: 400px; background: #EEF0FF; top: 40px; right: -120px; }
        .blob2 { width: 300px; height: 300px; background: #F0EDFF; top: 500px; left: -100px; }

        /* NAV */
        .nav { display: flex; align-items: center; justify-content: space-between; padding: 20px var(--pad); position: sticky; top: 0; z-index: 100; background: rgba(255,255,255,0.85); backdrop-filter: blur(12px); }
        .logo { display: flex; align-items: center; gap: 10px; font-size: 19px; font-weight: 700; color: #0f1115; text-decoration: none; }
        .logo-mark { width: 32px; height: 32px; background: var(--indigo); border-radius: 9px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; }
        .nav-links { display: flex; gap: 28px; }
        .nav-links a { font-size: 13px; color: #555; font-weight: 500; text-decoration: none; transition: color 0.2s; }
        .nav-links a:hover, .nav-links a.active { color: #0f1115; }
        .nav-right { display: flex; align-items: center; gap: 14px; }
        .nav-login { font-size: 13px; color: #555; font-weight: 500; text-decoration: none; }
        .nav-cta { background: var(--indigo); color: #fff; font-size: 12px; font-weight: 600; padding: 11px 24px; border-radius: 26px; text-decoration: none; transition: transform 0.2s, box-shadow 0.2s; }
        .nav-cta:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(79,70,229,0.3); }

        /* HERO */
        .hero { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; padding: 56px var(--pad) 72px; position: relative; z-index: 5; }
        .hero-eyebrow { font-size: 12px; color: var(--indigo); font-weight: 700; letter-spacing: 1px; margin-bottom: 18px; }
        .hero-title { font-size: 56px; font-weight: 800; line-height: 1.05; letter-spacing: -2px; margin-bottom: 22px; color: #0f1115; }
        .hero-title span { color: var(--indigo); }
        .hero-desc { font-size: 15px; color: #666; line-height: 1.7; margin-bottom: 30px; max-width: 400px; }
        .hero-btns { display: flex; gap: 12px; }
        .btn-primary { background: var(--indigo); color: #fff; font-size: 13px; font-weight: 600; padding: 14px 30px; border-radius: 28px; text-decoration: none; transition: transform 0.2s, box-shadow 0.2s; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(79,70,229,0.3); }
        .btn-secondary { background: #fff; color: #0f1115; font-size: 13px; font-weight: 600; padding: 14px 30px; border-radius: 28px; border: 1.5px solid #E5E7EB; text-decoration: none; transition: border-color 0.2s; }
        .btn-secondary:hover { border-color: var(--indigo); }
        .hero-img-wrap { position: relative; }
        .hero-img { width: 100%; height: 440px; border-radius: 22px; background-size: cover; background-position: center; box-shadow: 0 24px 70px rgba(79,70,229,0.18); }
        .hero-badge { position: absolute; bottom: -18px; left: -18px; background: #fff; border-radius: 18px; padding: 16px 20px; box-shadow: 0 14px 40px rgba(0,0,0,0.12); display: flex; align-items: center; gap: 14px; }
        .hero-badge-ic { width: 42px; height: 42px; background: #EEF0FF; border-radius: 13px; display: flex; align-items: center; justify-content: center; color: var(--indigo); font-size: 19px; }
        .hero-badge-n { font-size: 19px; font-weight: 800; color: #0f1115; }
        .hero-badge-l { font-size: 11px; color: #999; }

        /* TRUST */
        .trust { background: #F9FAFB; padding: 32px var(--pad); text-align: center; }
        .trust-label { font-size: 15px; color: #999; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 600; margin-bottom: 20px; }
        .trust-cats { display: flex; justify-content: center; gap: 44px; flex-wrap: wrap; }
        .trust-cat { display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 700; color: #9CA3AF; }
        .trust-cat i { font-size: 18px; color: var(--indigo); }

        /* ANIMATED STATS */
        .stats-band { padding-bottom: 50px; padding-top: 80px; background: #fff; position: relative; z-index: 5; }
        .stats-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 24px; max-width: 900px; margin: 0 auto; align-items: stretch; }
        .stat-box { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 32px 16px; border-radius: 20px; background: #F9FAFB; border: 1px solid #F3F4F6; transition: transform 0.3s, box-shadow 0.3s; min-height: 150px; }
        .stat-box:hover { transform: translateY(-5px); box-shadow: 0 12px 36px rgba(79,70,229,0.1); }
        .stat-value { display: flex; align-items: baseline; justify-content: center; gap: 2px; margin-bottom: 12px; }
        .stat-num { font-size: 44px; font-weight: 800; color: var(--indigo); letter-spacing: -1.5px; line-height: 1; }
        .stat-plus { font-size: 32px; font-weight: 800; color: var(--indigo); line-height: 1; }
        .stat-label { font-size: 12px; color: #888; font-weight: 500; letter-spacing: 0.3px; }

        /* SECTION */
        .sec { padding: 64px var(--pad); position: relative; z-index: 5; }
        .sec-head { text-align: center; margin-bottom: 44px; }
        .sec-eyebrow { font-size: 12px; color: var(--indigo); font-weight: 700; letter-spacing: 1px; margin-bottom: 10px; }
        .sec-title { font-size: 36px; font-weight: 800; letter-spacing: -1px; color: #0f1115; }
        .sec-sub { font-size: 14px; color: #888; margin-top: 12px; }

        .stories-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 26px; }
        .story { background: #fff; border-radius: 20px; overflow: hidden; cursor: pointer; box-shadow: 0 4px 20px rgba(0,0,0,0.04); border: 1px solid #F3F4F6; opacity: 0; }
        .story:hover { box-shadow: 0 16px 50px rgba(79,70,229,0.14); }
        .story-img { height: 220px; background-size: cover; background-position: center; position: relative; overflow: hidden; }
        .story-cat { position: absolute; top: 16px; left: 16px; background: #fff; color: var(--indigo); font-size: 10px; font-weight: 700; padding: 6px 13px; border-radius: 20px; z-index: 2; }
        .story-body { padding: 22px; }
        .story-title { font-size: 17px; font-weight: 700; line-height: 1.35; margin-bottom: 12px; letter-spacing: -0.3px; }
        .story-meta { display: flex; align-items: center; gap: 10px; font-size: 12px; color: #999; }
        .story-dot { width: 3px; height: 3px; background: #ccc; border-radius: 50%; }

        /* FEATURE BAND */
        .feature { background: var(--indigo); border-radius: 28px; margin: 0 var(--pad) 64px; padding: 56px; display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; position: relative; overflow: hidden; }
        .feature-blob { position: absolute; width: 280px; height: 280px; background: rgba(255,255,255,0.06); border-radius: 50%; top: -70px; right: -50px; }
        .feature-eyebrow { font-size: 12px; color: rgba(255,255,255,0.7); font-weight: 700; letter-spacing: 1px; margin-bottom: 16px; position: relative; }
        .feature-title { font-size: 32px; font-weight: 800; color: #fff; line-height: 1.15; letter-spacing: -0.8px; margin-bottom: 16px; position: relative; }
        .feature-desc { font-size: 14px; color: rgba(255,255,255,0.8); line-height: 1.7; margin-bottom: 24px; position: relative; }
        .feature-list { display: flex; flex-direction: column; gap: 12px; position: relative; }
        .feature-item { display: flex; align-items: center; gap: 12px; font-size: 13px; color: #fff; }
        .feature-item i { width: 24px; height: 24px; background: rgba(255,255,255,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 13px; }
        .feature-imgs { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; position: relative; }
        .feature-img { height: 160px; border-radius: 16px; background-size: cover; background-position: center; }

        /* TRENDING */
        .trend-list { display: flex; flex-direction: column; gap: 14px; max-width: 820px; margin: 0 auto; }
        .trend-row { display: flex; align-items: center; gap: 22px; padding: 18px; border-radius: 18px; cursor: pointer; border: 1px solid #F3F4F6; opacity: 0; transition: background 0.2s; }
        .trend-row:hover { background: #F9FAFB; }
        .trend-num { font-size: 26px; font-weight: 800; color: #E5E7EB; min-width: 40px; }
        .trend-img { width: 120px; height: 80px; border-radius: 14px; background-size: cover; background-position: center; flex-shrink: 0; }
        .trend-content { flex: 1; }
        .trend-cat { font-size: 10px; color: var(--indigo); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; }
        .trend-title { font-size: 16px; font-weight: 700; letter-spacing: -0.2px; }
        .trend-views { text-align: right; }
        .trend-views strong { display: block; font-size: 17px; font-weight: 800; color: #0f1115; }
        .trend-views span { font-size: 11px; color: #aaa; }

        /* AUTHOR */
        .author-card { display: flex; align-items: center; gap: 36px; max-width: 780px; margin: 0 auto; background: #F9FAFB; border-radius: 24px; padding: 40px; }
        .author-av { width: 110px; height: 110px; border-radius: 28px; background: var(--indigo); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 44px; font-weight: 800; flex-shrink: 0; }
        .author-label { font-size: 11px; letter-spacing: 1px; text-transform: uppercase; color: var(--indigo); font-weight: 700; margin-bottom: 10px; }
        .author-name { font-size: 28px; font-weight: 800; margin-bottom: 10px; letter-spacing: -0.5px; }
        .author-bio { font-size: 13px; color: #777; line-height: 1.7; margin-bottom: 18px; }
        .author-stats { display: flex; gap: 32px; }
        .author-stat-n { font-size: 22px; font-weight: 800; color: var(--indigo); }
        .author-stat-l { font-size: 10px; color: #aaa; letter-spacing: 0.5px; text-transform: uppercase; }

        /* TAGS */
        .tags-cloud { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; max-width: 780px; margin: 0 auto; }
        .tag { background: #F9FAFB; border: 1px solid #F3F4F6; padding: 10px 20px; font-size: 12px; color: #555; font-weight: 500; text-decoration: none; border-radius: 24px; display: flex; align-items: center; gap: 6px; opacity: 0; transition: all 0.2s; }
        .tag:hover { border-color: var(--indigo); color: var(--indigo); }
        .tag-hash { color: var(--indigo); font-weight: 700; }
        .tag-count { font-size: 10px; color: #bbb; }

        /* CATEGORIES */
        .cats-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; max-width: 820px; margin: 0 auto; }
        .cat { background: #fff; border: 1px solid #F3F4F6; border-radius: 18px; padding: 24px; display: flex; align-items: center; gap: 16px; cursor: pointer; text-decoration: none; opacity: 0; transition: box-shadow 0.2s, transform 0.2s; }
        .cat:hover { box-shadow: 0 10px 30px rgba(0,0,0,0.07); transform: translateY(-3px); }
        .cat-ic { width: 50px; height: 50px; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 21px; color: #fff; flex-shrink: 0; }
        .cat-name { font-size: 15px; font-weight: 700; margin-bottom: 3px; color: #0f1115; }
        .cat-count { font-size: 12px; color: #999; }

        /* ARTICLE FILTER (LIVEWIRE) */
        .filter-btns { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; margin-bottom: 36px; }
        .filter-btn { background: #fff; border: 1.5px solid #E5E7EB; border-radius: 26px; padding: 10px 22px; font-size: 13px; font-weight: 600; color: #555; cursor: pointer; transition: all 0.2s; font-family: 'Plus Jakarta Sans', sans-serif; }
        .filter-btn:hover { border-color: var(--indigo); color: var(--indigo); }
        .filter-btn.active { background: var(--indigo); border-color: var(--indigo); color: #fff; }
        .filter-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; max-width: 1000px; margin: 0 auto; }
        .filter-card { background: #fff; border: 1px solid #F3F4F6; border-radius: 18px; padding: 26px; cursor: pointer; transition: box-shadow 0.2s, transform 0.2s; }
        .filter-card:hover { box-shadow: 0 12px 36px rgba(79,70,229,0.1); transform: translateY(-3px); }
        .filter-card-cat { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px; }
        .filter-card-title { font-size: 17px; font-weight: 700; line-height: 1.4; letter-spacing: -0.3px; margin-bottom: 14px; color: #0f1115; }
        .filter-card-meta { font-size: 12px; color: #999; }
        .filter-empty { grid-column: 1 / -1; text-align: center; padding: 48px; color: #999; font-size: 14px; }

        @media (max-width: 768px) {
            .filter-grid { grid-template-columns: 1fr; }
        }

        /* NEWSLETTER */
        .nl { background: #0f1115; border-radius: 28px; margin: 0 var(--pad) 64px; padding: 56px; text-align: center; position: relative; overflow: hidden; }
        .nl-blob { position: absolute; width: 360px; height: 360px; background: rgba(79,70,229,0.25); border-radius: 50%; top: -120px; left: 50%; transform: translateX(-50%); filter: blur(50px); }
        .nl-title { font-size: 34px; font-weight: 800; color: #fff; letter-spacing: -1px; margin-bottom: 12px; position: relative; }
        .nl-sub { font-size: 14px; color: rgba(255,255,255,0.5); margin-bottom: 30px; position: relative; }
        .nl-form { display: flex; gap: 10px; justify-content: center; position: relative; }
        .nl-input { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 28px; padding: 15px 24px; font-size: 13px; color: #fff; width: 300px; outline: none; }
        .nl-input:focus { border-color: var(--indigo); }
        .nl-btn { background: var(--indigo); color: #fff; font-size: 13px; font-weight: 600; padding: 15px 32px; border-radius: 28px; border: none; cursor: pointer; transition: transform 0.2s; }
        .nl-btn:hover { transform: scale(1.03); }

        /* FOOTER */
        .footer { background: #0f1115; padding: 56px var(--pad) 28px; }
        .footer-top { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; padding-bottom: 40px; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .footer-brand .footer-logo { display: flex; align-items: center; gap: 10px; font-size: 18px; font-weight: 700; color: #fff; margin-bottom: 16px; }
        .footer-tagline { font-size: 13px; color: rgba(255,255,255,0.45); line-height: 1.7; max-width: 280px; margin-bottom: 22px; }
        .footer-social { display: flex; gap: 10px; }
        .social-ic { width: 38px; height: 38px; border-radius: 11px; background: rgba(255,255,255,0.06); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.6); font-size: 17px; text-decoration: none; transition: all 0.2s; }
        .social-ic:hover { background: var(--indigo); color: #fff; transform: translateY(-3px); }
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
            .hero { grid-template-columns: 1fr; gap: 32px; padding: 32px 20px 48px; }
            .hero-title { font-size: 36px; letter-spacing: -1px; }
            .hero-img { height: 280px; }
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
            .nav-links { display: none; }
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

<nav class="nav" id="navbar">
    <a href="{{ route('home') }}" class="logo"><div class="logo-mark"><i class="ti ti-bolt"></i></div>Nexus</a>
    <div class="nav-links">
        <a href="{{ route('home') }}" class="active">Home</a>
        <a href="#">AI & ML</a>
        <a href="#">Space</a>
        <a href="#">Biotech</a>
        <a href="#">About</a>
    </div>
    <div class="nav-right">
        <a href="{{ route('login') }}" class="nav-login">Login</a>
        <a href="{{ route('register') }}" class="nav-cta">Subscribe →</a>
    </div>
</nav>

{{-- HERO --}}
@if($featuredPost)
<section class="hero">
    <div class="hero-text">
        <div class="hero-eyebrow">PREMIUM TECH JOURNALISM</div>
        <h1 class="hero-title">Discover stories that <span>shape the future</span>.</h1>
        <p class="hero-desc">In-depth technology journalism covering AI, innovation, and the breakthroughs defining our era. Thoughtfully written for curious minds.</p>
        <div class="hero-btns">
            <a href="#" class="btn-primary">Start Reading →</a>
            <a href="#" class="btn-secondary">About Us</a>
        </div>
    </div>
    <div class="hero-img-wrap">
        <div class="hero-img" style="background-image:url('https://images.unsplash.com/photo-1677442136019-21780ecad995?w=700&q=80');"></div>
        <div class="hero-badge">
            <div class="hero-badge-ic"><i class="ti ti-eye"></i></div>
            <div><div class="hero-badge-n">24K+</div><div class="hero-badge-l">Monthly readers</div></div>
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
            <div class="story-img" style="background-image:url('{{ $imgs[$index % 4] }}');">
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

{{-- TRENDING --}}
<section class="sec" id="trend-sec" style="padding-top:0;">
    <div class="sec-head">
        <div class="sec-eyebrow">TRENDING NOW</div>
        <div class="sec-title">Most read this week</div>
    </div>
    <div class="trend-list">
        @php
            $trendImgs = [
                'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=300&q=80',
                'https://images.unsplash.com/photo-1446776877081-d282a0f896e2?w=300&q=80',
                'https://images.unsplash.com/photo-1509391366360-2e959784a276?w=300&q=80',
            ];
        @endphp
        @foreach($trendingPosts as $index => $post)
        <div class="trend-row">
            <div class="trend-num">0{{ $index + 1 }}</div>
            <div class="trend-img" style="background-image:url('{{ $trendImgs[$index % 3] }}');"></div>
            <div class="trend-content">
                <div class="trend-cat">{{ $post->category->name ?? 'Tech' }}</div>
                <div class="trend-title">{{ $post->title }}</div>
            </div>
            <div class="trend-views"><strong>{{ number_format($post->views / 1000, 1) }}K</strong><span>views</span></div>
        </div>
        @endforeach
    </div>
</section>

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

{{-- TAGS --}}
@if($popularTags->count() > 0)
<section class="sec" id="tags-sec" style="padding-top:0;">
    <div class="sec-head">
        <div class="sec-eyebrow">DISCOVER</div>
        <div class="sec-title">Popular topics</div>
    </div>
    <div class="tags-cloud">
        @foreach($popularTags as $tag)
        <a href="#" class="tag"><span class="tag-hash">#</span>{{ $tag->name }}<span class="tag-count">{{ $tag->posts_count }}</span></a>
        @endforeach
    </div>
</section>
{{-- EXPLORE ARTICLES (LIVEWIRE FILTER) --}}
<section class="sec" id="explore-sec" style="padding-top:0;">
    <div class="sec-head">
        <div class="sec-eyebrow">EXPLORE</div>
        <div class="sec-title">Browse all articles</div>
        <div class="sec-sub">Filter by category to find exactly what interests you</div>
    </div>
    <livewire:article-filter />
</section>
@endif

{{-- CATEGORIES --}}
<section class="sec" id="cats-sec" style="padding-top:0;">
    <div class="sec-head">
        <div class="sec-eyebrow">EXPLORE</div>
        <div class="sec-title">Browse by category</div>
    </div>
    <div class="cats-grid">
        @php
            $catIcons = ['ti-brain','ti-shield','ti-rocket','ti-dna','ti-bulb','ti-leaf'];
        @endphp
        @foreach($categories as $index => $category)
        <a href="#" class="cat">
            <div class="cat-ic" style="background: {{ $category->color }}"><i class="ti {{ $catIcons[$index % 6] }}"></i></div>
            <div>
                <div class="cat-name">{{ $category->name }}</div>
                <div class="cat-count">{{ $category->posts_count }} {{ Str::plural('story', $category->posts_count) }}</div>
            </div>
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
            <div class="footer-logo"><div class="logo-mark"><i class="ti ti-bolt"></i></div>Nexus</div>
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
        <div class="footer-copy">© {{ date('Y') }} Nexus Publications. All rights reserved.</div>
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
gsap.from('.hero-text > *', { opacity: 0, y: 30, duration: 0.8, stagger: 0.12, ease: 'power3.out', delay: 0.1 });
gsap.from('.hero-img-wrap', { opacity: 0, x: 40, duration: 0.9, ease: 'power3.out', delay: 0.3 });
gsap.from('.hero-badge', { opacity: 0, scale: 0.8, duration: 0.6, ease: 'back.out(1.7)', delay: 0.9 });

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
    const img = s.querySelector('.story-img');
    s.addEventListener('mouseenter', () => gsap.to(img, { scale: 1.08, duration: 0.5, ease: 'power2.out' }));
    s.addEventListener('mouseleave', () => gsap.to(img, { scale: 1, duration: 0.5, ease: 'power2.out' }));
});

// Feature band
gsap.from('.feature', { opacity: 0, scale: 0.96, duration: 0.8, ease: 'power3.out',
    scrollTrigger: { trigger: '#feature-sec', start: 'top 80%' } });
gsap.from('.feature-item', { opacity: 0, x: -20, duration: 0.5, stagger: 0.1, ease: 'power2.out',
    scrollTrigger: { trigger: '#feature-sec', start: 'top 70%' } });

// Trending rows
gsap.set('.trend-row', { opacity: 0, x: -30 });
ScrollTrigger.create({ trigger: '#trend-sec', start: 'top 80%',
    onEnter: () => gsap.to('.trend-row', { opacity: 1, x: 0, duration: 0.5, stagger: 0.1, ease: 'power2.out' }) });

// Author
gsap.from('.author-card', { opacity: 0, y: 40, duration: 0.8, ease: 'power3.out',
    scrollTrigger: { trigger: '#author-sec', start: 'top 82%' } });

// Tags
gsap.set('.tag', { opacity: 0, y: 15 });
ScrollTrigger.create({ trigger: '#tags-sec', start: 'top 85%',
    onEnter: () => gsap.to('.tag', { opacity: 1, y: 0, duration: 0.4, stagger: 0.04, ease: 'back.out(1.5)' }) });

// Categories
gsap.set('.cat', { opacity: 0, y: 30 });
ScrollTrigger.create({ trigger: '#cats-sec', start: 'top 82%',
    onEnter: () => gsap.to('.cat', { opacity: 1, y: 0, duration: 0.5, stagger: 0.08, ease: 'back.out(1.4)' }) });

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
document.querySelectorAll('a, button, .story, .cat, .trend-row, .tag').forEach(el => {
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