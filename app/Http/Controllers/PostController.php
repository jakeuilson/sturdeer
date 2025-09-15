<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Trend;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'recent');

        $query = Post::query()
            ->with('user')
            ->withCount('comments');

        if ($sort === 'popular') {
            $query->orderByDesc('comments_count');
        } else {
            $query->orderByDesc('created_at');
            $sort = 'recent';
        }

        $posts = $query->paginate(10)->withQueryString();

        return view('post.index', [
            'posts' => $posts,
            'sort' => $sort,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=> 'required',
            'content'=> 'required',
            'published_at' => ['nullable', 'datetime'],
        ]);

        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title']);

        Post::create($data);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load(['user', 'comments.user']);
        return view('posts.show', compact('post'));
    }

    /**
     * Search posts by title or content.
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        
        if (empty($query)) {
            return redirect()->route('dashboard')->with('error', 'Please enter a search term.');
        }

        $posts = Post::where('title', 'LIKE', "%{$query}%")
                    ->orWhere('content', 'LIKE', "%{$query}%")
                    ->with('user')
                    ->paginate(10)
                    ->withQueryString();

        return view('posts.search', compact('posts', 'query'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
