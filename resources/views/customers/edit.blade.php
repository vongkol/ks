@extends("layouts.customer")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Edit Customer</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/customer')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/admin/customer/update')}}" method="post" id="frm" class="form-horizontal">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$customer->id}}">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label for="first_name" class="control-label col-sm-3 lb">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="first_name" name="first_name" class="form-control" required value="{{$customer->first_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="control-label col-sm-3 lb">Last Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="last_name" name="last_name" class="form-control" required value="{{$customer->last_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="control-label col-sm-3 lb">Gender</label>
                            <div class="col-sm-9">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="Male" {{$customer->gender=='Male'?'selected':''}}>Male</option>
                                    <option value="Female" {{$customer->gender=='Female'?'selected':''}}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="control-label col-sm-3 lb">Email</label>
                            <div class="col-sm-9">
                                <input type="text" id="email" name="email" class="form-control" value="{{$customer->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="control-label col-sm-3 lb">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" id="phone" name="phone" class="form-control" value="{{$customer->phone}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="control-label col-sm-3 lb">Username <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="username" name="username" class="form-control" value="{{$customer->username}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="control-label col-sm-3 lb">Password </label>
                            <div class="col-sm-9">
                                <div class="txt-small">Leave this blank to keep the old password.</div>
                                <input type="password" id="password" name="password" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">&nbsp;</label>
                            <div class="col-sm-9">
                                    <button class="btn btn-primary btn-flat" type="submit">Save Changes</button>
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
        
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_customer").addClass("current");
        });
      
    </script>
@endsection