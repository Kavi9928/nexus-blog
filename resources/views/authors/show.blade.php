<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} — Nexus Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Newsreader:opsz,wght@6..72,700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.44.0/tabler-icons.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        body { background: #fff; color: #0f1115; overflow-x: hidden; }
        :root { --indigo: #4F46E5; --red: #D32F2F; --pad: clamp(24px, 8vw, 160px); }

        /* MASTHEAD + NEWSBAR (matches home / article pages) */
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
        .search-results { max-height: 400px; overflow-y: auto; }
        .search-result { display: block; padding: 16px 22px; text-decoration: none; border-bottom: 1px solid #F9FAFB; }
        .search-result:hover { background: #F9FAFB; }
        .search-result-cat { font-size: 10px; color: var(--indigo); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .search-result-title { font-size: 15px; font-weight: 700; color: #0f1115; margin-bottom: 4px; }
        .search-result-meta { font-size: 12px; color: #999; }
        .search-empty, .search-hint { padding: 28px 22px; text-align: center; color: #999; font-size: 14px; }

        /* AUTHOR HERO */
        .author-hero { display: flex; align-items: center; gap: 32px; padding: 48px var(--pad); border-bottom: 1px solid #E5E7EB; }
        .author-avatar { width: 132px; height: 132px; border-radius: 50%; object-fit: cover; flex-shrink: 0; background: #0f1115; }
        .author-eyebrow { font-size: 12px; color: var(--red); font-weight: 800; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 8px; }
        .author-name { font-family: 'Newsreader', Georgia, serif; font-size: 42px; font-weight: 700; line-height: 1.05; letter-spacing: -0.5px; }
        .author-title { font-size: 14px; color: #666; font-weight: 600; margin-top: 4px; }
        .author-bio { font-size: 15px; color: #555; line-height: 1.7; margin-top: 14px; max-width: 640px; }
        .author-meta { display: flex; align-items: center; gap: 26px; margin-top: 18px; flex-wrap: wrap; }
        .author-stat { display: flex; align-items: baseline; gap: 6px; }
        .author-stat b { font-size: 18px; font-weight: 800; }
        .author-stat span { font-size: 12px; color: #999; text-transform: uppercase; letter-spacing: 0.5px; }
        .author-socials { display: flex; gap: 10px; }
        .author-social { width: 36px; height: 36px; border: 1px solid #D8D8D8; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #0f1115; font-size: 15px; text-decoration: none; transition: all 0.2s; }
        .author-social:hover { background: #0f1115; color: #fff; border-color: #0f1115; }

        /* ARTICLE GRID */
        .author-body { padding: 44px var(--pad) 64px; }
        .author-body-label { font-size: 13px; color: var(--red); font-weight: 800; letter-spacing: 0.5px; text-transform: uppercase; border-bottom: 2px solid #0f1115; padding-bottom: 10px; margin-bottom: 30px; display: inline-block; }
        .ap-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; }
        .ap-card { background: #fff; border: 1px solid #E5E7EB; text-decoration: none; overflow: hidden; transition: border-color 0.2s; }
        .ap-card:hover { border-color: #0f1115; }
        .ap-img { height: 180px; background-size: cover; background-position: center; background-color: #f2f2f2; }
        .ap-body { padding: 18px 20px; }
        .ap-cat { font-size: 10px; color: var(--red); font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
        .ap-title { font-size: 16px; font-weight: 700; line-height: 1.4; color: #0f1115; margin-bottom: 10px; }
        .ap-meta { font-size: 12px; color: #999; }
        .ap-empty { grid-column: 1 / -1; text-align: center; color: #999; font-size: 14px; padding: 40px; }
        .ap-pagination { margin-top: 36px; }
        .ap-pagination a, .ap-pagination span { color: #0f1115; }

        /* FOOTER STRIP */
        .footer-strip { background: #0f1115; padding: 22px var(--pad); display: flex; align-items: center; justify-content: space-between; }
        .footer-strip-brand { font-family: 'Newsreader', Georgia, serif; font-size: 22px; font-weight: 700; color: #fff; text-decoration: none; }
        .footer-strip-copy { font-size: 12px; color: rgba(255,255,255,0.4); }

        @media (max-width: 900px) { .ap-grid { grid-template-columns: repeat(2,1fr); } }
        @media (max-width: 768px) {
            .masthead { padding: 18px 20px; }
            .masthead-brand { font-size: 30px; }
            .masthead-date, .masthead-login { display: none; }
            .newsbar-links { display: none; }
            .author-hero { flex-direction: column; text-align: center; }
            .author-meta { justify-content: center; }
            .ap-grid { grid-template-columns: 1fr; }
            .footer-strip { flex-direction: column; gap: 8px; }
        }
    </style>
</head>
<body>

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

<section class="author-hero">
    <img class="author-avatar" src="{{ $user->avatar_url }}" alt="{{ $user->name }}">
    <div>
        <div class="author-eyebrow">{{ $user->isAdmin() ? 'Editor' : 'Contributor' }}</div>
        <h1 class="author-name">{{ $user->name }}</h1>
        @if($user->title)<div class="author-title">{{ $user->title }}</div>@endif
        @if($user->bio)<p class="author-bio">{{ $user->bio }}</p>@endif
        <div class="author-meta">
            <div class="author-stat"><b>{{ number_format($stats['articles']) }}</b> <span>Articles</span></div>
            <div class="author-stat"><b>{{ number_format($stats['views']) }}</b> <span>Total views</span></div>
            @if($user->twitter || $user->linkedin || $user->website)
            <div class="author-socials">
                @if($user->twitter)<a href="{{ $user->twitter }}" target="_blank" rel="noopener" class="author-social" aria-label="Twitter"><i class="ti ti-brand-x"></i></a>@endif
                @if($user->linkedin)<a href="{{ $user->linkedin }}" target="_blank" rel="noopener" class="author-social" aria-label="LinkedIn"><i class="ti ti-brand-linkedin"></i></a>@endif
                @if($user->website)<a href="{{ $user->website }}" target="_blank" rel="noopener" class="author-social" aria-label="Website"><i class="ti ti-world"></i></a>@endif
            </div>
            @endif
        </div>
    </div>
</section>

<section class="author-body">
    <div class="author-body-label">Articles by {{ $user->name }}</div>
    <div class="ap-grid">
        @php
            $apImgs = [
                'https://images.unsplash.com/photo-1518770660439-4636190af475?w=500&q=80',
                'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=500&q=80',
                'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=500&q=80',
            ];
        @endphp
        @forelse($posts as $i => $post)
        <a href="{{ route('posts.show', $post) }}" class="ap-card">
            <div class="ap-img" style="background-image:url('{{ $post->featured_image ? Storage::url($post->featured_image) : $apImgs[$i % 3] }}');"></div>
            <div class="ap-body">
                <div class="ap-cat">{{ $post->category->name ?? 'Tech' }}</div>
                <div class="ap-title">{{ $post->title }}</div>
                <div class="ap-meta">{{ ($post->published_at ?? $post->created_at)->format('F j, Y') }} · {{ number_format($post->views) }} views</div>
            </div>
        </a>
        @empty
        <div class="ap-empty">{{ $user->name }} hasn't published any articles yet.</div>
        @endforelse
    </div>
    <div class="ap-pagination">{{ $posts->links() }}</div>
</section>

<footer class="footer-strip">
    <a href="{{ route('home') }}" class="footer-strip-brand">Nexus Blog</a>
    <div class="footer-strip-copy">© {{ date('Y') }} Nexus Blog. All rights reserved.</div>
</footer>

</body>
</html>
