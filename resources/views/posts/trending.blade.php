@extends('layouts.app')

@section('content')
<h1>Trending Posts</h1>
<ul>
    @foreach($posts as $post)
        <li>
            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            ({{ $post->comments_count }} comments)
        </li>
    @endforeach
</ul>
{{ $posts->links() }}
@endsection