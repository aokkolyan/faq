@extends('layouts.admin')
@section('content')
      

<form action="{{url('/question/update/'.$questions->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div  class="container mt-3">
        <input type="hidden" value="{{$questions->id}}">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="question_title" value="{{$questions->question_title}}" class="form-control" placeholder="Name">
            </div>
            @error('question_title')

            <span class="text-danger">{{ $message }}</span>

        @enderror
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{$questions->description}}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </div>
  </form>

@endsection