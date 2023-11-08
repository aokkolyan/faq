@extends('layouts.admin')
@section('content')


<form action="{{route('create')}}" method="POST">
    @csrf_token
    <div class="row g-3 align-items-center">
        <div class="col-auto">
          <label for="inputPassword6" class="col-form-label">question</label>
          <input type="text" name="question_title">
        </div>
        <div class="col-auto">
            <label for="inputPassword6" class="col-form-label">Description</label>
            <input type="text" name="description">
          </div>
        <button type="submit">Save</button>
      </div>
</form>

@endsection