@extends('base')

@section('header')
    @include('base.header')
@endsection

@section('content')
    <div class="container">
        <h2 class="my-4">Blog Lists</h2>
        <div class="table-responsive">
            <table id = "blogList"class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Blog Title</th>
                        <th>Author Name</th>
                        <th>Content</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->author_name }}</td>
                            <td>{{ Str::limit($blog->content, 50) }}</td>
                            <td>
                            <a href="{{ url('edit-blog/' . $blog->id . '?flow=blog') }}" class="text-primary" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="text-danger ml-3 delete-blog" data-id = "{{$blog->id}}" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('footer')
    @include('base.footer')
@endsection
