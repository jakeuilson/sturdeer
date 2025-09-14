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
                            <div class="border-b border-gray-200 pb-4">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center space-x-2">
                                        <span class="font-semibold text-gray-900">{{ $comment->user->name }}</span>
                                        <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                        @if(auth()->check())
                                            <span class="text-xs text-gray-400">(Auth ID: {{ auth()->id() }}, Comment User ID: {{ $comment->user_id }})</span>
                                        @endif
                                    </div>
                                    @if(auth()->check() && auth()->id() === $comment->user_id)
                                        <div class="flex space-x-2">
                                            <a href="{{ route('comments.edit', $comment) }}" 
                                               class="text-sm text-blue-600 hover:underline">Edit</a>
                                            <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-sm text-red-600 hover:underline"
                                                        onclick="return confirm('Are you sure you want to delete this comment?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                <p class="text-gray-700">{{ $comment->comment }}</p>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                No comments yet. Be the first to comment!
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>