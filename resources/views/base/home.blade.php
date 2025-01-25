@extends('base')

@section('header')
    @include('base.header')
@endsection

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <input type="text" id="search-input" class="form-control" placeholder="Search blogs by title">
        </div>
    </div>
    <div class="row" id="blogs-container">
        @foreach($blogs as $index => $blog)
            @php
                $date = $blog->updated_at;
            @endphp
            <div class="col-md-4 mb-4 blog-item">
                <div class="card" style="width: 100%;">
                    <img src="{{$blog->image_url}}" class="card-img-top" alt="Blog Image">
                    <div class="card-body">
                        <a href="{{ url('blog/' . $blog->id . '?flow=blog') }}" class="card-title">{{$blog->title}}</a>
                        <h6 class="text-muted small">{{$date}}</h6>
                        <h5>{{$blog->author_name}}</h5>
                    </div>
                </div>
            </div>
            @if(($index + 1) % 3 == 0)
                </div><div class="row">
            @endif
        @endforeach
    </div>
</div>

@endsection
@section('footer')
    @include('base.footer')
@endsection
