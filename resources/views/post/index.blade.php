<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-4">All Posts</h1>
                    <form method="GET" action="{{ route('posts.search') }}" class="flex gap-4">
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
                            class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            Search
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-trend-tabs>
                    OwO, nothing here?
                </x-trend-tabs>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse ($posts as $post)
                        <x-post-item :post="$post"></x-post-item>
                    @empty
                        <div class="text-center py-20">No Posts Found T_T</div>
                    @endforelse
                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>