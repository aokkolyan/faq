@extends('layouts.admin')
<title>WEG_Viewquestion</title>
@section('content')

<div class="container">
    <h4 style="text-align: center">Users management</h4>
    <div class="pull-right">
        <a class="btn btn-success" href="{{route('users.create')}}"> <i class="fa-sharp fa-solid fa-plus"></i></a>
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
            @foreach($users as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                    @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                     <label class="badge bg-success" >{{ $v }}</label>
                    @endforeach
                    @endif
                </td>
                    <td>
                        {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                    </td>
                    <td>
                        @if(Cache::has('user-is-online-' . $user->id))
                            <span class="badge bg-success">Online</span>
                        @else
                            <span class="badge bg-danger">Offline</span>
                        @endif
                    </td>
                    <td>
                    <a class="btn btn-info" href="{{route('users.show',$user->id)}}" title="Show"><i class="fa-solid fa-eye"></i></a>
                     <a class="btn btn-primary" href="{{route('users.edit',$user->id)}}" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                     {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                     <button class="btn btn-danger" title="Delete"> <i class="fa-sharp fa-solid fa-trash"></i></button>
                     {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $('.show_confirm').click(function(event) {

            var form = $(this).closest("form");
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
