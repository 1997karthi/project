@extends('base')

@section('header')
    @include('base.header')
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h3>Manually Add Blogs</h3>
                @csrf
                <div class="form-group">
                    <label for="name">Blog Title</label>
                    <input type="text" id="blog-title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="name">Author Name</label>
                    <input type="text" id="author-name" class="form-control"  required>
                </div>
                <div class="form-group">
                    <label for="name">Image Url</label><br>
                    <small><span style="color:red;">* </span>Please enter a valid .jpg image URL.</small>
                    <input type="text" id="image-url"class="form-control"  name="image_url" placeholder="Enter image URL" required><br><br>
                </div>
                <div class="form-group">
                    <label for="content"></label>
                    <textarea id="content" class="form-control" rows="4" placeholder="Enter your Blog Content here"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3 add-blog">Add Manually</button>
        </div>

        <div class="col-md-6">
            <h3>Import from CSV</h3>
                @csrf
            <small><span style="color:red;">* </span>Please use the following header names: blog-title, author-name, content, image_url.</small>
            <div class="form-group">
                <label for="csv_file">Choose CSV File</label>
                <input type="file" name="csv_file" id="csv_file" class="form-control" accept=".csv" required>
            </div>
            <button type="submit" class="btn btn-success mt-3 add-csv-blog">Import CSV</button>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('base.footer')
@endsection
