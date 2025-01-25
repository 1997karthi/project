<!-- This is a nav -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/')}}">
        <img src="https://cdn-icons-png.flaticon.com/512/60/60736.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Blog
    </a>
    <div class="ml-auto text-muted">
        <small>Current Location: <strong>Home</strong></small>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/')}}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('add-blog?flow=add') }}">Add Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('list-blog?flow=list-view') }}">Blogs</a>
            </li>
        </ul>
    </div>
</nav>
