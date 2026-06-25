<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS — Premium Tech Publication</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white">

    {{-- Navigation --}}
    <nav class="border-b border-yellow-600/20 px-6 py-4 flex items-center justify-between sticky top-0 bg-black/90 backdrop-blur-md z-50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-black" fill="currentColor" viewBox="0 0 20 20"><path d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"/></svg>
            </div>
            <span class="text-xl font-semibold tracking-widest">NEX<span class="text-yellow-400">US</span></span>
        </div>
        <div class="hidden md:flex items-center gap-8">
            <a href="#" class="text-xs tracking-widest uppercase text-white/60 hover:text-yellow-400 transition">Home</a>
            <a href="#" class="text-xs tracking-widest uppercase text-white/60 hover:text-yellow-400 transition">Technology</a>
            <a href="#" class="text-xs tracking-widest uppercase text-white/60 hover:text-yellow-400 transition">Innovation</a>
            <a href="#" class="text-xs tracking-widest uppercase text-white/60 hover:text-yellow-400 transition">About</a>
        </div>
        <div class="flex items-center gap-3">
            <div class="hidden md:flex items-center gap-2 bg-white/5 border border-yellow-600/20 rounded-full px-4 py-2">
                <svg class="w-3 h-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <span class="text-xs text-white/40">Search stories...</span>
            </div>
            <a href="/dashboard" class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-black text-xs font-semibold px-4 py-2 rounded-full tracking-widest uppercase">Subscribe</a>
        </div>
    </nav>

    {{-- News Ticker --}}
    <div class="bg-yellow-400/5 border-b border-yellow-600/15 px-6 py-2 flex items-center gap-4 overflow-hidden">
        <span class="bg-yellow-400 text-black text-xs font-semibold px-2 py-1 rounded tracking-widest shrink-0">LIVE</span>
        <div class="flex items-center gap-6 text-xs text-white/50 overflow-hidden">
            @foreach($trendingPosts as $trending)
                <span>{{ $trending->title }}</span>
                <span class="text-yellow-400">◆</span>
            @endforeach
        </div>
    </div>

    {{-- Hero Section --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 border-b border-yellow-600/10">

        {{-- Featured Post --}}
        <div class="lg:col-span-3 p-8 border-r border-yellow-600/10 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/3 to-transparent pointer-events-none"></div>
            @if($featuredPost)
                <div class="inline-flex items-center gap-2 bg-yellow-400/10 border border-yellow-400/25 text-yellow-400 text-xs px-3 py-1 rounded tracking-widest uppercase mb-6">
                    <span class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></span>
                    Featured Story
                </div>
                <h1 class="text-3xl md:text-4xl font-medium leading-tight mb-4 tracking-tight">
                    {{ $featuredPost->title }}
                </h1>
                <p class="text-white/50 text-sm leading-relaxed mb-6 max-w-lg">
                    {{ $featuredPost->excerpt }}
                </p>
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center text-black text-xs font-semibold">
                        {{ strtoupper(substr($featuredPost->user->name, 0, 1)) }}
                    </div>
                    <div class="text-xs text-white/40">
                        <span class="text-white/70">{{ $featuredPost->user->name }}</span>
                        &nbsp;·&nbsp; {{ $featuredPost->published_at->format('M d, Y') }}
                        &nbsp;·&nbsp; {{ $featuredPost->reading_time }} min read
                    </div>
                    <a href="#" class="ml-auto text-xs text-yellow-400 tracking-widest uppercase flex items-center gap-1 hover:gap-2 transition-all">
                        Read <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            @endif
        </div>

        {{-- Latest Posts Sidebar --}}
        <div class="lg:col-span-2">
            @foreach($latestPosts as $index => $post)
                <div class="flex gap-4 p-5 border-b border-yellow-600/10 hover:bg-yellow-400/3 transition cursor-pointer">
                    <span class="text-3xl font-medium text-yellow-400/20">0{{ $index + 1 }}</span>
                    <div>
                        @if($post->category)
                            <div class="text-xs text-yellow-400 tracking-widest uppercase mb-1">{{ $post->category->name }}</div>
                        @endif
                        <div class="text-sm text-white/75 leading-snug mb-1">{{ $post->title }}</div>
                        <div class="text-xs text-white/30">{{ $post->reading_time }} min read · {{ number_format($post->views) }} views</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Features Bar --}}
    <div class="grid grid-cols-2 md:grid-cols-4 border-b border-yellow-600/10">
        <div class="flex items-center gap-3 p-5 border-r border-yellow-600/10">
            <div class="w-8 h-8 bg-yellow-400/10 border border-yellow-400/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
            </div>
            <div>
                <div class="text-xs text-white/70 font-medium">AI Summaries</div>
                <div class="text-xs text-white/30">Every article, instant TL;DR</div>
            </div>
        </div>
        <div class="flex items-center gap-3 p-5 border-r border-yellow-600/10">
            <div class="w-8 h-8 bg-yellow-400/10 border border-yellow-400/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
            </div>
            <div>
                <div class="text-xs text-white/70 font-medium">Reading List</div>
                <div class="text-xs text-white/30">Save for later, anytime</div>
            </div>
        </div>
        <div class="flex items-center gap-3 p-5 border-r border-yellow-600/10">
            <div class="w-8 h-8 bg-yellow-400/10 border border-yellow-400/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <div>
                <div class="text-xs text-white/70 font-medium">Live Trending</div>
                <div class="text-xs text-white/30">Real-time view counters</div>
            </div>
        </div>
        <div class="flex items-center gap-3 p-5">
            <div class="w-8 h-8 bg-yellow-400/10 border border-yellow-400/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <div class="text-xs text-white/70 font-medium">Read Progress</div>
                <div class="text-xs text-white/30">Track your reading</div>
            </div>
        </div>
    </div>

    {{-- Trending Section --}}
    <div class="p-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3 text-xs text-yellow-400 tracking-widest uppercase">
                <div class="w-5 h-px bg-yellow-400"></div>
                Trending Now
            </div>
            <a href="#" class="text-xs text-white/30 tracking-widest uppercase hover:text-yellow-400 transition">See all →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($trendingPosts as $post)
                <div class="bg-white/3 border border-yellow-600/10 rounded-xl p-5 hover:border-yellow-400/30 transition cursor-pointer group">
                    <div class="h-20 rounded-lg mb-4 flex items-center justify-center"
                         style="background: linear-gradient(135deg, {{ $post->category->color ?? '#D4AF37' }}20, {{ $post->category->color ?? '#D4AF37' }}05)">
                        <span class="text-2xl">⚡</span>
                    </div>
                    @if($post->category)
                        <div class="text-xs text-yellow-400 tracking-widest uppercase mb-2">{{ $post->category->name }}</div>
                    @endif
                    <div class="text-sm text-white/80 leading-snug mb-3 group-hover:text-white transition">{{ $post->title }}</div>
                    <div class="flex items-center gap-3 text-xs text-white/30">
                        <span>👁 {{ number_format($post->views) }}</span>
                        <span>🕐 {{ $post->reading_time }} min</span>
                        <div class="flex-1 h-px bg-white/5 rounded">
                            <div class="h-full bg-gradient-to-r from-yellow-400 to-yellow-600 rounded" style="width: {{ min(100, ($post->views / 20000) * 100) }}%"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Categories --}}
    <div class="px-8 pb-8">
        <div class="flex items-center gap-3 text-xs text-yellow-400 tracking-widest uppercase mb-6">
            <div class="w-5 h-px bg-yellow-400"></div>
            Browse Categories
        </div>
        <div class="flex flex-wrap gap-3">
            @foreach($categories as $category)
                <a href="#" class="flex items-center gap-2 bg-white/3 border border-yellow-600/10 rounded-full px-4 py-2 text-xs text-white/60 hover:border-yellow-400/30 hover:text-white transition">
                    <span class="w-2 h-2 rounded-full" style="background: {{ $category->color }}"></span>
                    {{ $category->name }}
                    <span class="text-white/30">({{ $category->posts_count }})</span>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Footer --}}
    <footer class="border-t border-yellow-600/10 px-8 py-6 flex items-center justify-between">
        <span class="text-xl font-semibold tracking-widest">NEX<span class="text-yellow-400">US</span></span>
        <span class="text-xs text-white/20">© 2026 Nexus. All rights reserved.</span>
    </footer>

</body>
</html>