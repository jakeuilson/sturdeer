@extends('layouts.app')

@section('content')
<h1>All Blog Posts</h1>
<form method="GET" action="{{ route('posts.search') }}">
    <input type="text" name="query" placeholder="Search...">
    <button type="submit">Search</button>
</form>
<ul>
    @foreach($posts as $post)
        <li>
            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            ({{ $post->comments_count ?? $post->comments->count() }} comments)
        </li>
    @endforeach
</ul>
{{ $posts->links() }}
@endsection