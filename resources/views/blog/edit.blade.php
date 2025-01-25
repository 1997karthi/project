@extends('base')

@section('header')
    @include('base.header')
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h3>Edit Blogs</h3>
                @csrf
                <div class="form-group">
                    <label for="name">Blog Title</label>
                    <input type="text" id="blog-title" class="form-control" value = "{{$blog->title}}" required>
                </div>
                <div class="form-group">
                    <label for="name">Author Name</label>
                    <input type="text" id="author-name" class="form-control" value = "{{$blog->author_name}}" required>
                </div>
                <div class="form-group">
                    <label for="name">Image Url</label><br>
                    <small><span style="color:red;">* </span>Please enter a valid .jpg image URL.</small>
                    <input type="text" id="image-url" class="form-control" name="image_url" placeholder="Enter image URL" value="{{ $blog->image_url }}" required><br><br>
                    <div id="image-preview" style="margin-top: 10px;">
                        @if($blog->image_url)
                            <img src="{{ $blog->image_url }}" id="image-preview-img" alt="Preview" style="max-width: 200px; max-height: 200px;">
                        @endif
                    </div>
                </div>
                <input type = "hidden" value = "{{$blog->id}}" id = "blog-id"/>
                <div class="form-group">
                    <label for="content"></label>
                    <textarea id="content" class="form-control" rows="4" placeholder="Enter your Blog Content here">{{ $blog->content }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3 edit-blog">Save</button>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('base.footer')
@endsection
