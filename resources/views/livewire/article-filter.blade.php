<div>
    {{-- FILTER BUTTONS --}}
    <div class="filter-btns">
        <button
            wire:click="setCategory('all')"
            class="filter-btn {{ $selectedCategory === 'all' ? 'active' : '' }}">
            All
        </button>
        @foreach($categories as $category)
            <button
                wire:click="setCategory({{ $category->id }})"
                class="filter-btn {{ $selectedCategory == $category->id ? 'active' : '' }}">
                {{ $category->name }}
            </button>
        @endforeach
    </div>

    {{-- POSTS GRID --}}
    <div class="filter-grid">
        @forelse($posts as $post)
            <div class="filter-card" wire:key="post-{{ $post->id }}">
                <div class="filter-card-cat" style="color: {{ $post->category->color ?? '#4F46E5' }}">
                    {{ $post->category->name ?? 'Tech' }}
                </div>
                <div class="filter-card-title">{{ $post->title }}</div>
                <div class="filter-card-meta">
                    {{ $post->reading_time }} min read · {{ number_format($post->views) }} views
                </div>
            </div>
        @empty
            <div class="filter-empty">No articles in this category yet.</div>
        @endforelse
    </div>
</div>