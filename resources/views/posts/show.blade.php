<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} — Nexus Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Newsreader:opsz,wght@6..72,700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.44.0/tabler-icons.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        body { background: #fff; color: #0f1115; overflow-x: hidden; }
        :root { --indigo: #4F46E5; --red: #D32F2F; --pad: clamp(24px, 8vw, 160px); }

        #progress { position: fixed; top: 0; left: 0; width: 0%; height: 3px; background: var(--red); z-index: 9999; }

        /* MASTHEAD (matches home) */
        .masthead { display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; padding: 24px var(--pad); background: #fff; }
        .masthead-left { display: flex; align-items: center; gap: 10px; justify-self: start; }
        .search-trigger { background: none; border: none; padding: 4px; cursor: pointer; display: flex; align-items: center; font-size: 19px; color: #333; transition: color 0.2s; }
        .search-trigger:hover { color: var(--indigo); }
        .masthead-date { font-size: 13px; color: #444; font-weight: 500; }
        .masthead-brand { font-family: 'Newsreader', Georgia, serif; font-weight: 700; font-size: 40px; letter-spacing: -0.5px; color: #0f1115; text-decoration: none; line-height: 1; justify-self: center; }
        .masthead-right { display: flex; align-items: center; gap: 18px; justify-self: end; }
        .masthead-login { font-size: 13px; color: #555; font-weight: 500; text-decoration: none; }
        .masthead-cta { background: var(--indigo); color: #fff; font-size: 12px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; padding: 11px 24px; border-radius: 4px; text-decoration: none; transition: opacity 0.2s; }
        .masthead-cta:hover { opacity: 0.88; }

        /* NEWS NAV BAR (matches home) */
        .newsbar { display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; padding: 10px var(--pad); position: sticky; top: 0; z-index: 100; background: rgba(255,255,255,0.92); backdrop-filter: blur(12px); border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB; }
        .newsbar-archives { justify-self: start; background: #0f1115; color: #fff; font-size: 12.5px; font-weight: 600; padding: 10px 22px; border-radius: 4px; text-decoration: none; }
        .newsbar-links { display: flex; gap: 30px; justify-self: center; }
        .newsbar-links a { font-size: 13.5px; color: #222; font-weight: 600; text-decoration: none; transition: color 0.2s; }
        .newsbar-links a:hover { color: var(--indigo); }
        .newsbar-social { display: flex; align-items: center; gap: 14px; justify-self: end; }
        .newsbar-social a { color: #333; font-size: 16px; text-decoration: none; display: flex; transition: color 0.2s; }
        .newsbar-social a:hover { color: var(--indigo); }

        /* SEARCH OVERLAY (livewire component) */
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

        /* BREADCRUMB */
        .crumbs { padding: 22px var(--pad) 0; display: flex; align-items: center; gap: 12px; font-size: 13px; font-weight: 700; }
        .crumbs a { color: #0f1115; text-decoration: none; }
        .crumbs a:hover { color: var(--red); }
        .crumbs-sep { color: #C9C9C9; font-weight: 400; }
        .crumbs-current { color: var(--red); }

        /* ARTICLE LAYOUT */
        .article-wrap { display: grid; grid-template-columns: minmax(0, 1fr) 320px; gap: 48px; padding: 26px var(--pad) 64px; align-items: start; }

        .article-title { font-size: 40px; font-weight: 800; line-height: 1.18; letter-spacing: -1px; margin-bottom: 18px; }
        .article-standfirst { font-size: 18px; color: #555; line-height: 1.65; font-weight: 500; margin-bottom: 24px; }
        .article-byline { display: flex; flex-wrap: wrap; align-items: center; gap: 6px 18px; padding: 14px 0; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB; font-size: 13px; color: #666; margin-bottom: 18px; }
        .article-byline .by strong { color: #0f1115; font-weight: 700; }
        .article-byline span { display: inline-flex; align-items: center; gap: 5px; }

        .article-share { display: flex; align-items: center; gap: 10px; margin-bottom: 26px; }
        .share-btn { width: 38px; height: 38px; border: 1px solid #D8D8D8; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #0f1115; font-size: 16px; text-decoration: none; cursor: pointer; transition: all 0.2s; }
        .share-btn:hover { background: #0f1115; border-color: #0f1115; color: #fff; }

        .article-figure { margin-bottom: 8px; }
        .article-img { width: 100%; height: 430px; background-size: cover; background-position: center; }
        .article-caption { display: flex; gap: 8px; align-items: baseline; padding: 10px 0; border-bottom: 1px solid #E5E7EB; margin-bottom: 28px; font-size: 12.5px; color: #777; line-height: 1.5; }
        .article-caption i { color: #999; font-size: 13px; flex-shrink: 0; transform: translateY(1px); }

        .article-content { font-size: 17px; line-height: 1.9; color: #2a2a2a; max-width: 720px; }
        .article-content p { margin-bottom: 26px; }

        .article-tags { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 36px; padding-top: 24px; border-top: 1px solid #E5E7EB; }
        .article-tag { background: #fff; border: 1px solid #E5E7EB; padding: 8px 16px; font-size: 12px; color: #555; font-weight: 600; text-decoration: none; }
        .article-tag:hover { border-color: #0f1115; color: #0f1115; }
        .article-source { margin-top: 26px; font-size: 13px; color: #888; }
        .article-source strong { color: #0f1115; }

        /* SIDEBAR */
        .sidebar { border-left: 1px solid #E5E7EB; padding-left: 32px; position: sticky; top: 76px; }
        .sidebar-label { font-size: 13px; color: var(--red); font-weight: 800; letter-spacing: 0.5px; margin-bottom: 6px; }
        .sidebar-item { display: block; text-decoration: none; padding: 16px 0; border-bottom: 1px solid #EEE; }
        .sidebar-item:last-of-type { border-bottom: none; }
        .sidebar-row { display: flex; gap: 14px; align-items: flex-start; }
        .sidebar-num { font-family: 'Newsreader', Georgia, serif; font-size: 30px; font-weight: 700; color: #C9C9C9; line-height: 1; min-width: 26px; }
        .sidebar-item:hover .sidebar-title { color: var(--red); }
        .sidebar-title { font-size: 14.5px; font-weight: 700; color: #0f1115; line-height: 1.45; transition: color 0.15s; }
        .sidebar-cat { font-size: 10px; color: var(--red); font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .sidebar-nl { margin-top: 28px; background: #0f1115; padding: 26px 22px; }
        .sidebar-nl-title { color: #fff; font-size: 17px; font-weight: 800; margin-bottom: 8px; }
        .sidebar-nl-sub { color: rgba(255,255,255,0.55); font-size: 12.5px; line-height: 1.6; margin-bottom: 16px; }
        .sidebar-nl-btn { display: block; background: #fff; color: #0f1115; text-align: center; font-size: 12.5px; font-weight: 700; padding: 12px; text-decoration: none; transition: opacity 0.2s; }
        .sidebar-nl-btn:hover { opacity: 0.85; }

        /* RELATED */
        .related { border-top: 1px solid #E5E7EB; padding: 48px var(--pad) 64px; }
        .related-label { font-size: 13px; color: var(--red); font-weight: 800; letter-spacing: 0.5px; text-align: center; margin-bottom: 8px; }
        .related-title { font-size: 28px; font-weight: 800; letter-spacing: -0.5px; text-align: center; margin-bottom: 36px; }
        .related-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; max-width: 1100px; margin: 0 auto; }
        .related-card { background: #fff; border: 1px solid #E5E7EB; text-decoration: none; overflow: hidden; transition: border-color 0.2s; }
        .related-card:hover { border-color: #0f1115; }
        .related-img { height: 180px; background-size: cover; background-position: center; }
        .related-body { padding: 18px 20px; }
        .related-cat { font-size: 10px; color: var(--red); font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
        .related-card-title { font-size: 16px; font-weight: 700; line-height: 1.4; color: #0f1115; margin-bottom: 10px; }
        .related-meta { font-size: 12px; color: #999; }
        .related-empty { text-align: center; color: #999; font-size: 14px; grid-column: 1 / -1; }

        /* FOOTER STRIP */
        .footer-strip { background: #0f1115; padding: 22px var(--pad); display: flex; align-items: center; justify-content: space-between; }
        .footer-strip-brand { font-family: 'Newsreader', Georgia, serif; font-size: 22px; font-weight: 700; color: #fff; text-decoration: none; }
        .footer-strip-copy { font-size: 12px; color: rgba(255,255,255,0.4); }

        @media (max-width: 900px) {
            .article-wrap { grid-template-columns: 1fr; gap: 40px; }
            .sidebar { border-left: none; padding-left: 0; position: static; border-top: 1px solid #E5E7EB; padding-top: 24px; }
        }
        @media (max-width: 768px) {
            .masthead { padding: 18px 20px; }
            .masthead-brand { font-size: 30px; }
            .masthead-date, .masthead-login { display: none; }
            .newsbar-links { display: none; }
            .article-title { font-size: 28px; letter-spacing: -0.5px; }
            .article-img { height: 240px; }
            .related-grid { grid-template-columns: 1fr; }
            .footer-strip { flex-direction: column; gap: 8px; }
        }
    </style>
</head>
<body>

<div id="progress"></div>

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

<nav class="newsbar">
    <a href="{{ route('home') }}#explore-sec" class="newsbar-archives">Archives</a>
    <div class="newsbar-links">
        <a href="{{ route('home') }}">Home</a>
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

<div class="crumbs">
    <a href="{{ route('home') }}">News</a>
    <span class="crumbs-sep">|</span>
    <span class="crumbs-current">{{ $post->category->name ?? 'Technology' }}</span>
</div>

<div class="article-wrap">
    <article>
        <h1 class="article-title">{{ $post->title }}</h1>
        <p class="article-standfirst">{{ $post->excerpt }}</p>

        <div class="article-byline">
            <span class="by">By&nbsp;<strong>{{ $post->user->name }}</strong></span>
            <span>Published On {{ ($post->published_at ?? $post->created_at)->format('j M Y') }}</span>
            <span><i class="ti ti-clock"></i> {{ $post->reading_time }} min read</span>
            <span><i class="ti ti-eye"></i> {{ number_format($post->views) }} views</span>
        </div>

        <div class="article-share">
            <a class="share-btn" target="_blank" rel="noopener" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" aria-label="Share on Facebook"><i class="ti ti-brand-facebook"></i></a>
            <a class="share-btn" target="_blank" rel="noopener" href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}" aria-label="Share on X"><i class="ti ti-brand-x"></i></a>
            <a class="share-btn" target="_blank" rel="noopener" href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->fullUrl()) }}" aria-label="Share on WhatsApp"><i class="ti ti-brand-whatsapp"></i></a>
            <button class="share-btn" id="copyLink" aria-label="Copy link"><i class="ti ti-link"></i></button>
        </div>

        <figure class="article-figure">
            <div class="article-img" style="background-image:url('https://images.unsplash.com/photo-1677442136019-21780ecad995?w=1000&q=80');"></div>
            <figcaption class="article-caption">
                <i class="ti ti-camera"></i>
                {{ $post->excerpt ? Str::limit($post->excerpt, 110) : $post->title }} [Nexus Blog]
            </figcaption>
        </figure>

        <div class="article-content">
            {!! nl2br(e($post->content)) !!}
        </div>

        @if($post->tags->count() > 0)
        <div class="article-tags">
            @foreach($post->tags as $tag)
                <a href="#" class="article-tag"># {{ $tag->name }}</a>
            @endforeach
        </div>
        @endif

        <p class="article-source">Source: <strong>Nexus Blog</strong></p>
    </article>

    <aside class="sidebar">
        <div class="sidebar-label">MOST READ</div>
        @foreach($mostRead as $i => $mr)
        <a href="{{ route('posts.show', $mr) }}" class="sidebar-item">
            <div class="sidebar-row">
                <div class="sidebar-num">{{ $i + 1 }}</div>
                <div>
                    <div class="sidebar-cat">{{ $mr->category->name ?? 'Tech' }}</div>
                    <div class="sidebar-title">{{ $mr->title }}</div>
                </div>
            </div>
        </a>
        @endforeach

        <div class="sidebar-nl">
            <div class="sidebar-nl-title">Don't miss a story</div>
            <div class="sidebar-nl-sub">The best tech stories delivered to your inbox every morning. No spam, ever.</div>
            <a href="{{ route('register') }}" class="sidebar-nl-btn">Subscribe Free →</a>
        </div>
    </aside>
</div>

{{-- RELATED POSTS --}}
<section class="related">
    <div class="related-label">KEEP READING</div>
    <h2 class="related-title">Related Articles</h2>
    <div class="related-grid">
        @php
            $relatedImgs = [
                'https://images.unsplash.com/photo-1518770660439-4636190af475?w=500&q=80',
                'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=500&q=80',
                'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=500&q=80',
            ];
        @endphp
        @forelse($relatedPosts as $i => $related)
        <a href="{{ route('posts.show', $related) }}" class="related-card">
            <div class="related-img" style="background-image:url('{{ $relatedImgs[$i % 3] }}');"></div>
            <div class="related-body">
                <div class="related-cat">{{ $related->category->name ?? 'Tech' }}</div>
                <div class="related-card-title">{{ $related->title }}</div>
                <div class="related-meta">{{ $related->reading_time }} min read · {{ number_format($related->views) }} views</div>
            </div>
        </a>
        @empty
        <div class="related-empty">No related articles yet.</div>
        @endforelse
    </div>
</section>

<footer class="footer-strip">
    <a href="{{ route('home') }}" class="footer-strip-brand">Nexus Blog</a>
    <div class="footer-strip-copy">© {{ date('Y') }} Nexus Blog. All rights reserved.</div>
</footer>

<script>
window.addEventListener('scroll', () => {
    const pct = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
    document.getElementById('progress').style.width = pct + '%';
});

// entrance animations
gsap.from('.article-title, .article-standfirst, .article-byline, .article-share', { opacity: 0, y: 20, duration: 0.6, stagger: 0.08, ease: 'power2.out' });
gsap.from('.article-figure', { opacity: 0, y: 24, duration: 0.7, delay: 0.25, ease: 'power2.out' });
gsap.from('.sidebar', { opacity: 0, x: 20, duration: 0.7, delay: 0.3, ease: 'power2.out' });

// copy link button
const copyBtn = document.getElementById('copyLink');
copyBtn.addEventListener('click', () => {
    navigator.clipboard.writeText(window.location.href).then(() => {
        copyBtn.innerHTML = '<i class="ti ti-check"></i>';
        setTimeout(() => copyBtn.innerHTML = '<i class="ti ti-link"></i>', 1500);
    });
});
</script>

</body>
</html>
