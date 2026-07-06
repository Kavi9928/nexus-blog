<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} — Nexus Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.44.0/tabler-icons.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        body { background: #fff; color: #0f1115; overflow-x: hidden; }
        :root { --indigo: #4F46E5; --pad: 80px; }

        #progress { position: fixed; top: 0; left: 0; width: 0%; height: 3px; background: var(--indigo); z-index: 9999; }

        /* NAV */
        .nav { display: flex; align-items: center; justify-content: space-between; padding: 20px var(--pad); position: sticky; top: 0; z-index: 100; background: rgba(255,255,255,0.85); backdrop-filter: blur(12px); }
        .logo { display: flex; align-items: center; gap: 10px; font-size: 19px; font-weight: 700; color: #0f1115; text-decoration: none; }
        .logo-mark { width: 32px; height: 32px; background: var(--indigo); border-radius: 9px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; }
        .nav-back { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #555; font-weight: 600; text-decoration: none; transition: color 0.2s; }
        .nav-back:hover { color: var(--indigo); }

        /* ARTICLE */
        .article { max-width: 760px; margin: 0 auto; padding: 48px 24px; }
        .article-cat { display: inline-block; background: #EEF0FF; color: var(--indigo); font-size: 11px; font-weight: 700; padding: 7px 16px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 20px; }
        .article-title { font-size: 42px; font-weight: 800; line-height: 1.15; letter-spacing: -1.5px; margin-bottom: 20px; }
        .article-excerpt { font-size: 17px; color: #666; line-height: 1.7; margin-bottom: 28px; }
        .article-meta { display: flex; align-items: center; gap: 16px; padding-bottom: 28px; border-bottom: 1px solid #F3F4F6; margin-bottom: 32px; }
        .article-av { width: 48px; height: 48px; border-radius: 14px; background: var(--indigo); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 19px; font-weight: 800; flex-shrink: 0; }
        .article-author { flex: 1; }
        .article-author strong { display: block; font-size: 14px; font-weight: 700; }
        .article-author span { font-size: 12px; color: #999; }
        .article-stats { display: flex; gap: 16px; font-size: 12px; color: #999; }
        .article-stats span { display: flex; align-items: center; gap: 5px; }

        .article-img { width: 100%; height: 400px; border-radius: 20px; background-size: cover; background-position: center; margin-bottom: 36px; }

        .article-content { font-size: 16px; line-height: 1.9; color: #333; }
        .article-content p { margin-bottom: 24px; }

        /* TAGS */
        .article-tags { display: flex; flex-wrap: wrap; gap: 8px; margin: 36px 0; padding-top: 28px; border-top: 1px solid #F3F4F6; }
        .article-tag { background: #F9FAFB; border: 1px solid #F3F4F6; padding: 8px 16px; font-size: 12px; color: #555; font-weight: 500; text-decoration: none; border-radius: 20px; }
        .article-tag:hover { border-color: var(--indigo); color: var(--indigo); }

        /* RELATED */
        .related { background: #F9FAFB; padding: 56px var(--pad); }
        .related-title { font-size: 26px; font-weight: 800; letter-spacing: -0.5px; text-align: center; margin-bottom: 36px; }
        .related-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; max-width: 1000px; margin: 0 auto; }
        .related-card { background: #fff; border-radius: 18px; padding: 24px; text-decoration: none; border: 1px solid #F3F4F6; transition: box-shadow 0.2s, transform 0.2s; }
        .related-card:hover { box-shadow: 0 12px 36px rgba(79,70,229,0.1); transform: translateY(-3px); }
        .related-cat { font-size: 10px; color: var(--indigo); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px; }
        .related-card-title { font-size: 16px; font-weight: 700; line-height: 1.4; color: #0f1115; margin-bottom: 12px; }
        .related-meta { font-size: 12px; color: #999; }
        .related-empty { text-align: center; color: #999; font-size: 14px; grid-column: 1 / -1; }

        @media (max-width: 768px) {
            :root { --pad: 20px; }
            .article-title { font-size: 30px; }
            .article-img { height: 240px; }
            .related-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div id="progress"></div>

<nav class="nav">
    <a href="{{ route('home') }}" class="logo"><div class="logo-mark"><i class="ti ti-bolt"></i></div>Nexus Blog</a>
    <a href="{{ route('home') }}" class="nav-back"><i class="ti ti-arrow-left"></i> Back to Home</a>
</nav>

<article class="article">
    <span class="article-cat">{{ $post->category->name ?? 'Technology' }}</span>
    <h1 class="article-title">{{ $post->title }}</h1>
    <p class="article-excerpt">{{ $post->excerpt }}</p>

    <div class="article-meta">
        <div class="article-av">{{ strtoupper(substr($post->user->name, 0, 1)) }}</div>
        <div class="article-author">
            <strong>{{ $post->user->name }}</strong>
            <span>{{ $post->published_at?->format('F j, Y') ?? $post->created_at->format('F j, Y') }}</span>
        </div>
        <div class="article-stats">
            <span><i class="ti ti-clock"></i> {{ $post->reading_time }} min read</span>
            <span><i class="ti ti-eye"></i> {{ number_format($post->views) }} views</span>
        </div>
    </div>

    <div class="article-img" style="background-image:url('https://images.unsplash.com/photo-1677442136019-21780ecad995?w=900&q=80');"></div>

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
</article>

{{-- RELATED POSTS --}}
<section class="related">
    <h2 class="related-title">Related Articles</h2>
    <div class="related-grid">
        @forelse($relatedPosts as $related)
        <a href="{{ route('posts.show', $related) }}" class="related-card">
            <div class="related-cat">{{ $related->category->name ?? 'Tech' }}</div>
            <div class="related-card-title">{{ $related->title }}</div>
            <div class="related-meta">{{ $related->reading_time }} min read · {{ number_format($related->views) }} views</div>
        </a>
        @empty
        <div class="related-empty">No related articles yet.</div>
        @endforelse
    </div>
</section>

<script>
window.addEventListener('scroll', () => {
    const pct = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
    document.getElementById('progress').style.width = pct + '%';
});
</script>

</body>
</html>
