@extends('layouts.admin')
@section('content')
<form action="{{ url('/question/updateanswer/'.$answer->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div  class="container mt-3">
        <input type="hidden" value="{{$answer->id}}">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Answer:</strong>
                <textarea id="summernote" name="title_answer"  placeholder="Answer..........">{{$answer->title_answer}}</textarea>
            </div>
            @error('title_answer')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </div>
  </form>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
     $('.show_confirm').click(function(event) {

        var form =  $(this).closest("form");
        var name = $(this).data("name");

        event.preventDefault();

        swal({

            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {

        if (willDelete) {
            form.submit();
        }
        });
     });
         $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
            });
        });
    </script>
@endsection