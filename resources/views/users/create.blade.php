@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Create New User</strong>&nbsp;&nbsp;
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
            <form action="{{url('/user/save')}}" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="first_name" class="control-label col-sm-3 lb">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="first_name" name="first_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="control-label col-sm-3 lb">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="control-label col-sm-3 lb">Gender <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="gender" id="gender" class="form-control sl">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="control-label col-sm-3 lb">Username <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="control-label col-sm-3 lb">Password <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="password" required name="password" id="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirm_password" class="control-label col-sm-3 lb">Confirm Password <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="password" required name="confirm_password" id="confirm_password" class="form-control">
                                <br>
                                <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class="form-group row">
                            <label for="email" class="control-label col-sm-3 lb">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="control-label col-sm-3 lb">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="control-label col-sm-3 lb">Role <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="role" id="role" class="form-control sl">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="control-label col-sm-3 lb">Photo</label>
                            <div class="col-sm-9">
                                <input type="file" value="" name="photo" id="photo" class="form-control" onchange="loadFile(event)">
                                <br>
                                <img src="{{asset('profile/default.png')}}" alt="" width="72" id="preview">
                            </div>
                        </div>
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