<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-6">All Posts</h1>
                    
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('posts.search') }}" class="flex gap-4 mb-6">
                        <div class="flex-1">
                            <input 
                                type="text" 
                                name="query" 
                                placeholder="Search posts by title or content..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                        </div>
                        <button 
                            type="submit" 
                            class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                        >
                            Search
                        </button>
                    </form>
                    
                    <!-- Trend Tabs -->
                    <x-trend-tabs :sort="$sort" />
                </div>
            </div>
            
            <!-- Posts Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse ($posts as $post)
                        <div class="mb-6 last:mb-0">
                            <x-post-item :post="$post" />
                        </div>
                    @empty
                        <div class="text-center py-20">
                            <div class="text-gray-500 text-lg">No posts found</div>
                            <div class="text-gray-400 text-sm mt-2">Try adjusting your search or check back later</div>
                        </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                @if($posts->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>