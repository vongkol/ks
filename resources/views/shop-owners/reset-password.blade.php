@extends("layouts.customer")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Reset New Password Shop Owner</strong>&nbsp;&nbsp;
            <a href="{{url('/shop-owner')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/shop-owner/reset')}}"  method="post" id="frm" onsubmit="check(event)" class="form-horizontal">
                {{csrf_field()}}
                <input type="hidden" value="{{$shop_owner->id}}" name="id">
                <div class="row">
                    <div class="col-sm-6">
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
                        <label class="control-label col-sm-3 lb"></label>
                            <div class="col-sm-9">
                                <p></p>
                                <button class="btn btn-warning btn-flat" type="submit">Reset Password</button>
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