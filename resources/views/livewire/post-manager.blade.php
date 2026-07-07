<div>
    {{-- SUCCESS MESSAGE --}}
    @if(session('message'))
        <div class="mb-4 rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">
            {{ session('message') }}
        </div>
    @endif

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Manage Posts</h2>
        @if(!$showForm)
            <button wire:click="create" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 transition">
                + New Post
            </button>
        @endif
    </div>

    {{-- FORM (create/edit) --}}
    @if($showForm)
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 mb-8">
        <h3 class="text-base font-semibold text-gray-800 mb-4">{{ $editingPostId ? 'Edit Post' : 'Create New Post' }}</h3>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" wire:model="title" placeholder="Enter post title"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('title') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
            <textarea wire:model="excerpt" rows="2" placeholder="Short summary"
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
            @error('excerpt') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
            <textarea wire:model="content" rows="6" placeholder="Write your article..."
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
            @error('content') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select wire:model="category_id"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Select category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select wire:model="status"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
                @error('status') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button wire:click="save" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 transition">
                {{ $editingPostId ? 'Update Post' : 'Create Post' }}
            </button>
            <button wire:click="cancel" class="inline-flex items-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 border border-gray-300 shadow-sm hover:bg-gray-50 transition">
                Cancel
            </button>
        </div>
    </div>
    @endif

    {{-- POSTS TABLE --}}
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
        <div class="grid grid-cols-[1fr_140px_110px_90px_150px] gap-4 px-6 py-3 bg-gray-50 border-b border-gray-200 text-xs font-semibold uppercase tracking-wide text-gray-500">
            <div>Title</div>
            <div>Category</div>
            <div>Status</div>
            <div>Views</div>
            <div>Actions</div>
        </div>
        @forelse($posts as $post)
        <div class="grid grid-cols-[1fr_140px_110px_90px_150px] gap-4 px-6 py-4 border-b border-gray-100 items-center text-sm" wire:key="post-{{ $post->id }}">
            <div class="font-medium text-gray-800 truncate">{{ $post->title }}</div>
            <div class="text-gray-600">{{ $post->category->name ?? '—' }}</div>
            <div>
                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold
                    @class([
                        'bg-green-100 text-green-800' => $post->status === 'published',
                        'bg-gray-100 text-gray-700' => $post->status === 'draft',
                        'bg-amber-100 text-amber-800' => $post->status === 'pending',
                        'bg-red-100 text-red-800' => $post->status === 'rejected',
                    ])">
                    {{ ucfirst($post->status) }}
                </span>
            </div>
            <div class="text-gray-600">{{ number_format($post->views) }}</div>
            <div class="flex items-center gap-3">
                <button wire:click="edit({{ $post->id }})" class="text-indigo-600 hover:text-indigo-500 font-medium">Edit</button>
                <button wire:click="delete({{ $post->id }})" wire:confirm="Delete this post?" class="text-red-600 hover:text-red-500 font-medium">Delete</button>
            </div>
        </div>
        @empty
        <div class="px-6 py-10 text-center text-sm text-gray-500">No posts yet. Create your first one!</div>
        @endforelse
    </div>
</div>
