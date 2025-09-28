<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Post Content -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
                    <div class="text-sm text-gray-600 mb-4">
                        By <span class="font-semibold">{{ $post->user->name }}</span> 
                        on {{ $post->created_at->format('M d, Y') }}
                    </div>
                    <div class="prose max-w-none">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">Comments ({{ $post->comments->count() }})</h2>
                    
                    <!-- Comment Form -->
                    @auth
                    <div class="mb-8">
                        <form method="POST" action="{{ route('comments.store', $post) }}" class="space-y-4">
                            @csrf
                            <div>
                                <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                                    Add a comment
                                </label>
                                <textarea 
                                    name="comment" 
                                    id="comment"
                                    rows="4"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Write your comment here..."
                                    required
                                >{{ old('comment') }}</textarea>
                                @error('comment')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Post Comment
                                </button>
                            </div>
                        </form>
                    </div>
                    @else
                    <div class="mb-8 p-4 bg-gray-50 rounded-md">
                        <p class="text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-600 hover:underline">login</a> to post a comment.</p>
                    </div>
                    @endauth

                    <!-- Comments List -->
                    <div class="space-y-6">
                        @forelse($post->comments as $comment)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                            <span class="text-white text-sm font-medium">
                                                {{ substr($comment->user->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="font-semibold text-gray-900">{{ $comment->user->name }}</span>
                                            <span class="text-sm text-gray-500 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    @if(auth()->check() && auth()->id() === $comment->user_id)
                                        <div class="flex space-x-2">
                                            <a href="{{ route('comments.edit', $comment) }}" 
                                               class="text-sm text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200">Edit</a>
                                            <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-sm text-red-600 hover:text-red-800 hover:underline transition-colors duration-200"
                                                        onclick="return confirm('Are you sure you want to delete this comment?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                <p class="text-gray-700 leading-relaxed">{{ $comment->comment }}</p>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No comments yet</h3>
                                <p class="text-gray-500">Be the first to share your thoughts!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>