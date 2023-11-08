<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
      
<title>Test</title>
      
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" />
</head>
      
<body>
    <div class="container mt-5">
        @foreach ($posts as $item)
         {!!$item->body!!}
        @endforeach
        <h1>Test Editor</h1>
        <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" />
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea id="summernote" name="body"></textarea>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success btn-block">Save</button>
            </div>
        </form>
    </div>
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 500,
                
            });
        });
    </script>
        
</body>
</html>