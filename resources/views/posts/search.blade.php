<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-4">Search Results</h1>
                    <p class="text-gray-600 mb-4">
                        @if($posts->count() > 0)
                            Found {{ $posts->total() }} result(s) for "<span class="font-semibold">{{ $query }}</span>"
                        @else
                            No results found for "<span class="font-semibold">{{ $query }}</span>"
                        @endif
                    </p>
                    
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('posts.search') }}" class="flex gap-4">
                        <div class="flex-1">
                            <input 
                                type="text" 
                                name="query" 
                                value="{{ $query }}"
                                placeholder="Search posts by title or content..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required
                            >
                        </div>
                        <button 
                            type="submit" 
                            class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            Search
                        </button>
                    </form>
                </div>
            </div>

            <!-- Search Results -->
            @if($posts->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="space-y-6">
                            @foreach($posts as $post)
                                <div class="border-b border-gray-200 pb-6 last:border-b-0">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h2 class="text-xl font-semibold text-gray-900 mb-2">
                                                <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600">
                                                    {{ $post->title }}
                                                </a>
                                            </h2>
                                            <div class="text-sm text-gray-600 mb-3">
                                                By <span class="font-medium">{{ $post->user->name }}</span> 
                                                on {{ $post->created_at->format('M d, Y') }}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-gray-700 mb-3">
                                        @if(strlen($post->content) > 200)
                                            {{ Str::limit($post->content, 200) }}
                                            <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline">Read more...</a>
                                        @else
                                            {{ $post->content }}
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                                            <span>{{ $post->comments->count() }} comment(s)</span>
                                        </div>
                                        <a href="{{ route('posts.show', $post) }}" 
                                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            View Post →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-12 text-center">
                        <div class="text-gray-400 mb-4">
                            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No posts found</h3>
                        <p class="text-gray-500 mb-6">Try adjusting your search terms or browse all posts.</p>
                        <a href="{{ route('dashboard') }}" 
                           class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Browse All Posts
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
