@extends('layouts.setting')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <strong>Reset Password</strong>&nbsp;&nbsp;
            <a href="{{url('/user')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
            <hr>
            @if(Session::has('sms'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('sms')}}
                    </div>
                </div>
            @endif
            @if(Session::has('sms1'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('sms1')}}
                    </div>
                </div>
            @endif
            <form action="{{url('/user/save-password')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to reset?')">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="form-group row">
                    <label for="new_password" class="control-label col-sm-2">New Password <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="password" required  name="new_password" value="{{old('new_password')}}" id="new_password" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="confirm_password" class="control-label col-sm-2">Confirm Password <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="password" required  name="confirm_password" value="{{old('confirm_password')}}"
                               id="confirm_password" class="form-control">
                        <br>
                        <button class="btn btn-primary btn-flat" type="submit">Save</button>
                        <a href="{{url('/user')}}" class="btn btn-danger btn-flat">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#user").addClass("current");
        })
    </script>
@endsection