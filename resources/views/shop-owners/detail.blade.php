@extends("layouts.customer")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Detail Shop Owner</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/shop-owner')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a> | <a href="{{url('/admin/shop-owner/edit/'.$shop_owner->id)}}" class="text-danger"><i class="fa fa-pencil"></i> <b>Edit</b></a>
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
            <form class="form-horizontal">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="photo" class="control-label col-sm-3 lb"></label>
                            <label  class="control-label col-sm-9 lb">
                                <img src="{{asset('uploads/shop_owners/profile/'.$shop_owner->photo)}}" alt="" width="72" id="preview">
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="first_name" class="control-label col-sm-3 lb">First Name <span class="text-danger">*</span></label>
                            <label  class="control-label col-sm-9 lb">
                                : {{$shop_owner->first_name}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="control-label col-sm-3 lb">Last Name</label>
                            <label  class="control-label col-sm-9 lb">
                                : {{$shop_owner->last_name}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="control-label col-sm-3 lb">Gender  <span class="text-danger">*</span></label>
                            <label  class="control-label col-sm-9 lb">
                                : {{$shop_owner->gender}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="control-label col-sm-3 lb">Email <span class="text-danger">*</span></label>
                            <label  class="control-label col-sm-9 lb">
                                : {{$shop_owner->email}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="control-label col-sm-3 lb">Phone</label>
                            <label  class="control-label col-sm-9 lb">
                                : {{$shop_owner->phone}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="control-label col-sm-3 lb">Address</label>
                            <label  class="control-label col-sm-9 lb">
                                : {{$shop_owner->address}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="control-label col-sm-3 lb">Username <span class="text-danger">*</span></label>
                            <label  class="control-label col-sm-9 lb">
                                : {{$shop_owner->username}}
                            </label>
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
            $("#menu_shop_owner").addClass("current");
        })
    </script>
@endsection