@extends('layouts.admin')
<title>WEG_Viewquestion</title>
@section('content')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<style>
    span[data-target] {
        cursor: pointer;
      }
      
      .pw-toggle {
        height: 1rem;
      }
</style>
    <div class="container">
        <h4 style="text-align: center">Users management</h4>
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> <i class="fa-sharp fa-solid fa-plus"></i></a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Last Usage</th>
                    <th>Active</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $v)
                                    <label class="badge bg-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                        </td>
                        <td>
                            @if (Cache::has('user-is-online-' . $user->id))
                                <span class="badge bg-success">Online</span>
                            @else
                                <span class="badge bg-danger">Offline</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('users.show', $user->id) }}" title="Show"><i
                                    class="fa-solid fa-eye"></i></a>
                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}" title="Edit"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                            <button class="btn btn-danger" title="Delete"> <i
                                    class="fa-sharp fa-solid fa-trash"></i></button>
                            <a href="" class="btn  btn-info" title="Reset password" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                                    class="fa-solid fa-lock" ></i></a>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                   
                @endforeach
            </tbody>
        </table>

    </div>
   
    <form action="{{ route('reset.password', $user->id) }}" method="POST">
        @csrf
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 60px">
            <div class="modal-dialog ">
                <div class="modal-content ">
                    <div class="modal-header ">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Reset Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div clas="control mb-4">
                            
                            <label for="reset-password">Reset Password</label><br>
                            <div class="input-group">
                              <input type="password" name="password" id="password" placeholder="New Password"  class="form-control" required />
                              <span class="input-group-text">
                              <span data-target="#password" class="pw-toggle2 material-icons">visibility</span>
                              </span>
                            </div>

                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                             @endif
                          </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(function() {
        $("span.pw-toggle, span.pw-toggle2").click(function() {
          var $pwField = $($(this).data().target);
          var TorP = $pwField.attr('type') == 'password' ? 'text' : 'password';
          $(this).text(TorP === "password" ? "visibility" : "visibility_off")
          $pwField.attr('type', TorP);
        });
      });
    //Chang the type of input to password or tesx
    {{--  function Toggle() {
        var temp = document.getElementById("typassword");

        if(temp.type == "password") {
            temp.type = "text";
        }
        else {
            tem.type = "password";
        }
    }  --}}
</script>
@endsection
