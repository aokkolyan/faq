@extends('layouts.admin')


@section('content')
<div class="container h-100 mt-5">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6">
        <h3>{{$answers}}</h3>
        <hr>
          <div class="form-group">
            <p>hh</p>
          </div>
          <h3>Answer</h3>
        <form action="#" method="POST">
            @csrf
            <div class="form-group">
              <hr>
                <label for="">Your Answer</label>
                <textarea class="form-control"  name="title_answer" rows="3" ></textarea>
              </div>
              <button type="submit" class="btn mt-3 btn-primary">Post Your Answer</button>
        </form>
      </div>
    </div>
</div>
@endsection