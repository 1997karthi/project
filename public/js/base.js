$(document).ready(function() {
    //blog list pagination
    $('#blogList').DataTable();
    //comment add blog
    $('.comment-submit').on('click', function() {
        var author_name = $('#author_name').val();
        var content = $('#content').val();
        var blogId = $('#blogId').val();
        $.ajax({
            url:'/comments',
            method: 'POST',
            data: {
                author_name: author_name,
                content: content,
                blogId:blogId
            },
            success: function(result) {
                location.reload();
            }
        });
    });
    //create new blog
    $('.add-blog').on('click', function() {
        var blogTitle = $('#blog-title').val();
        var authorName = $('#author-name').val();
        var content = $('#content').val();
        var imageUrl = $('#image-url').val();
        if (!imageUrl.toLowerCase().endsWith('.jpg')) {
            alertify.error('Please enter a valid');
        } else {
            $.ajax({
                url:'/manual-add',
                method: 'POST',
                data: {
                    blogTitle: blogTitle,
                    authorName: authorName,
                    content:content,
                    imageUrl:imageUrl
                },
                success: function(result) {
                    if(result.success){
                       alertify.success(result.message);
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }else{
                        alertify.error(result.message);
                    }
                }
            });
        }
    });

    //create new bulk blog
    $('.add-csv-blog').on('click', function() {
        var fileInput = $('#csv_file')[0];
        if (fileInput.files.length > 0) {
            var file = fileInput.files[0];
            var formData = new FormData();
            formData.append('file', file);
            $.ajax({
                url: '/csv-import',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alertify.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    alertify.error('Upload failed:', xhr.responseText);
                }
            });
        } else {
            alertify.error('No file selected');
        }
    });
    //delete bulk blog
    $('.delete-blog').on('click', function() {
        var blogId = $(this).data('id');
        alertify.confirm("Did you want to delete the blog?",
            function(){
                deleteBlog(blogId);
            },
        ).set({title:""})
        .set('labels', {ok: "Yes", cancel: "No"});
        alertify.set('notifier','position', 'top-center');
    });
    function deleteBlog(blogId){
        $.ajax({
            url:'/blog-delete',
            method: 'GET',
            data: {
                blogId: blogId
            },
            success: function(result) {
                if(result.success){
                    alertify.success(result.message);
                     setTimeout(function() {
                         location.reload();
                     }, 2000);
                }else{
                    alertify.error(result.message);
                }
            }
        });
    }
    //edit bulk blog
    $('.edit-blog').on('click', function() {
        var blogTitle = $('#blog-title').val();
        var authorName = $('#author-name').val();
        var content = $('#content').val();
        var imageUrl = $('#image-url').val();
        var blogId = $('#blog-id').val();
        if (!imageUrl.toLowerCase().endsWith('.jpg')) {
            alertify.error('Please enter a valid');
        } else {
            $.ajax({
                url:'/blog-edit-save',
                method: 'POST',
                data: {
                    blogTitle: blogTitle,
                    authorName: authorName,
                    content:content,
                    imageUrl:imageUrl,
                    blogId:blogId
                },
                success: function(result) {
                    if(result.success){
                       alertify.success(result.message);
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }else{
                        alertify.error(result.message);
                    }
                }
            });
        }
    });
    //seacrh blog
    $('#search-input').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();
        $('.blog-item').each(function() {
            var title = $(this).find('.card-title').text().toLowerCase();
            if (title.indexOf(searchTerm) !== -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});