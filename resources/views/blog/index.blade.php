@extends('base')
@section('header')
    @include('base.header')
@endsection
@section('content')
<div class="container">
    <img src="{{ $blog->image_url }}" class="card-img-top" alt="Blog Image">
    <h1 class="my-4">{{ $blog->title }}</h1>
    <p class="text-muted">{{ \Carbon\Carbon::parse($blog->created_at)->format('F j, Y') }}</p>
    <p>{{ $blog->content }}</p>
    <h4>Comments</h4>
    @foreach($blogComments as $comment)
        <div class="comment">
            <strong>{{ $comment->name }}</strong>
            <p>{{ $comment->comment }}</p>
            <p class="text-muted">{{ \Carbon\Carbon::parse($comment->updated_at)->format('F j, Y h:i A') }}</p>
            <hr>
        </div>
    @endforeach
    <input type = "hidden" value = "{{$blog->id}}" id = "blogId" />
    @csrf
    <form id="commentForm">
        <div class="form-group">
            <label for="author_name">Your Name</label>
            <input type="text" name="author_name" id="author_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">Your Comment</label>
            <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3 comment-submit">Post Comment</button>
    </form>
</div>
@endsection
@section('footer')
    @include('base.footer')
@endsection