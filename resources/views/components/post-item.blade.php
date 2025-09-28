<article class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
    <a href="{{ route('posts.show', $post) }}" class="block p-6 hover:bg-gray-50 transition-colors duration-200">
        <div class="flex justify-between items-start mb-3">
            <h2 class="text-xl font-bold text-gray-900 hover:text-blue-600 transition-colors duration-200 line-clamp-2">
                {{ $post->title }}
            </h2>
            <div class="flex items-center text-sm text-gray-500 ml-4 flex-shrink-0">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                {{ $post->comments_count ?? $post->comments->count() }}
            </div>
        </div>
        
        <p class="text-gray-700 text-sm leading-relaxed line-clamp-3 mb-4">
            {{ Str::words($post->content, 25) }}
        </p>
        
        <div class="flex items-center justify-between text-sm text-gray-500">
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="font-medium">{{ $post->user->name }}</span>
            </div>
            <time datetime="{{ $post->created_at->toISOString() }}" class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ $post->created_at->diffForHumans() }}
            </time>
        </div>
    </a>
</article>