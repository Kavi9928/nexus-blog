<div class="pm">
    {{-- SUCCESS MESSAGE --}}
    @if(session('message'))
        <div class="pm-alert">{{ session('message') }}</div>
    @endif

    {{-- HEADER --}}
    <div class="pm-header">
        <h2 class="pm-title">Manage Posts</h2>
        @if(!$showForm)
            <button wire:click="create" class="pm-btn-primary">+ New Post</button>
        @endif
    </div>

    {{-- FORM (create/edit) --}}
    @if($showForm)
    <div class="pm-form">
        <h3 class="pm-form-title">{{ $editingPostId ? 'Edit Post' : 'Create New Post' }}</h3>

        <div class="pm-field">
            <label>Title</label>
            <input type="text" wire:model="title" placeholder="Enter post title">
            @error('title') <span class="pm-error">{{ $message }}</span> @enderror
        </div>

        <div class="pm-field">
            <label>Excerpt</label>
            <textarea wire:model="excerpt" rows="2" placeholder="Short summary"></textarea>
            @error('excerpt') <span class="pm-error">{{ $message }}</span> @enderror
        </div>

        <div class="pm-field">
            <label>Content</label>
            <textarea wire:model="content" rows="6" placeholder="Write your article..."></textarea>
            @error('content') <span class="pm-error">{{ $message }}</span> @enderror
        </div>

        <div class="pm-row">
            <div class="pm-field">
                <label>Category</label>
                <select wire:model="category_id">
                    <option value="">Select category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="pm-error">{{ $message }}</span> @enderror
            </div>

            <div class="pm-field">
                <label>Status</label>
                <select wire:model="status">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
                @error('status') <span class="pm-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="pm-form-actions">
            <button wire:click="save" class="pm-btn-primary">
                {{ $editingPostId ? 'Update Post' : 'Create Post' }}
            </button>
            <button wire:click="cancel" class="pm-btn-secondary">Cancel</button>
        </div>
    </div>
    @endif

    {{-- POSTS TABLE --}}
    <div class="pm-table">
        <div class="pm-table-head">
            <div>Title</div>
            <div>Category</div>
            <div>Status</div>
            <div>Views</div>
            <div>Actions</div>
        </div>
        @forelse($posts as $post)
        <div class="pm-table-row" wire:key="post-{{ $post->id }}">
            <div class="pm-cell-title">{{ $post->title }}</div>
            <div>{{ $post->category->name ?? '—' }}</div>
            <div>
                <span class="pm-badge pm-badge-{{ $post->status }}">{{ ucfirst($post->status) }}</span>
            </div>
            <div>{{ number_format($post->views) }}</div>
            <div class="pm-actions">
                <button wire:click="edit({{ $post->id }})" class="pm-btn-edit">Edit</button>
                <button wire:click="delete({{ $post->id }})" wire:confirm="Delete this post?" class="pm-btn-delete">Delete</button>
            </div>
        </div>
        @empty
        <div class="pm-empty">No posts yet. Create your first one!</div>
        @endforelse
    </div>
</div>
