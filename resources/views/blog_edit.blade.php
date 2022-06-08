<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Page</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    Edit Blog
                </div>
                <div class="card-body">
                    <form action="{{route('blog_edit_action', $blog->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" value="{{$blog->title}}" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Content</label>
                            <input type="text" value="{{$blog->content}}" name="blog_content" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-sm mt-2">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
