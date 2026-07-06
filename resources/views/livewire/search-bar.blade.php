<div>
    {{-- SEARCH TRIGGER BUTTON (sits in the nav) --}}
    <button wire:click="open" class="search-trigger" aria-label="Search">
        <i class="ti ti-search"></i>
    </button>

    {{-- SEARCH OVERLAY (teleported to body so the nav's sticky stacking context doesn't cap its z-index;
         always rendered — an empty @teleport breaks Alpine — and toggled via display) --}}
    @teleport('body')
    <div class="search-overlay" wire:click.self="close" @if(!$isOpen) style="display:none" @endif>
        <div class="search-box">
            <div class="search-input-wrap">
                <i class="ti ti-search search-input-icon"></i>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="query"
                    class="search-input"
                    placeholder="Search articles..."
                    autofocus
                >
                <button wire:click="close" class="search-close" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>

            {{-- RESULTS --}}
            @if(strlen($query) >= 2)
                <div class="search-results">
                    @forelse($results as $post)
                        <a href="{{ route('posts.show', $post) }}" class="search-result" wire:key="search-{{ $post->id }}">
                            <div class="search-result-cat">{{ $post->category->name ?? 'Tech' }}</div>
                            <div class="search-result-title">{{ $post->title }}</div>
                            <div class="search-result-meta">{{ $post->reading_time }} min read · {{ number_format($post->views) }} views</div>
                        </a>
                    @empty
                        <div class="search-empty">No articles found for "{{ $query }}"</div>
                    @endforelse
                </div>
            @elseif(strlen($query) === 1)
                <div class="search-hint">Type at least 2 characters...</div>
            @endif
        </div>
    </div>
    @endteleport
</div>
