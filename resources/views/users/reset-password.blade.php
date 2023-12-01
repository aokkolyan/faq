@extends('layouts.admin')
<title>WEG_Viewquestion</title>
@section('content')
    <div class="container">
        {{--  <form action="{{ route('reset.password') }}" method="POST">
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
                                <label for="">Reset Password</label>
                                <div class="input-group">
                                  <input type="password" name="password" id="password" placeholder="New Password" size="40" maxlength="40" class="form-control" required />
                                  <span class="input-group-text">
                                  <span data-target="#password" class="pw-toggle2 material-icons">visibility</span>
                                  </span>
                                </div>
                              </div>
                            
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>  --}}
    </div>
@endsection
@section('script')
@endsection
