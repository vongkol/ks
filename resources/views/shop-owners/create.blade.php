@extends("layouts.customer")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Create New Shop Owner</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/shop-owner')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/admin/shop-owner/save')}}" onsubmit="check(event)" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="first_name" class="control-label col-sm-3 lb">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" value="{{old('first_name')}}" id="first_name" name="first_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="control-label col-sm-3 lb">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{old('last_name')}}" id="last_name" name="last_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="control-label col-sm-3 lb">Gender  <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                               <select name="gender"  class="form-control" id="gender">
                                   <option value="male">Male</option>
                                   <option value="female">Female</option>
                               </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="control-label col-sm-3 lb">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" id="email" value="{{old('email')}}" name="email" class="form-control"​ required>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="phone" class="control-label col-sm-3 lb">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone" value="{{old('phone')}}" id="phone" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="control-label col-sm-3 lb">Address</label>
                            <div class="col-sm-9">
                                <textarea name="address" id="address" class="form-control">{{old('address')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="control-label col-sm-3 lb">Username <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="username" value="{{old('username')}}" name="username" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="control-label col-sm-3 lb">Password <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="password" id="password" name="password" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="c_password" class="control-label col-sm-3 lb">Confirm Password <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="password" id="c_password" name="c_password" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="control-label col-sm-3 lb">Photo</label>
                            <div class="col-sm-9">
                                <input type="file" value="" name="photo" id="photo" class="form-control" onchange="loadFile(event)">
                                <br>
                                <img src="{{asset('uploads/shop_owners/profile/default.png')}}" alt="" width="72" id="preview">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label class="control-label col-sm-3 lb"></label>
                            <div class="col-sm-9">
                                <p></p>
                                <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
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
        function check(event)
        {
            var password = document.getElementById("password").value;
            var c_password = document.getElementById("c_password").value;

            if( password != c_password) {
                document.getElementById("c_password").style.border="2px solid red";
                event.preventDefault();
            } 

            if( password === confirm_password){
                document.getElementById("frm").submit();
            }
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_shop_owner").addClass("current");
        })
    </script>
@endsection