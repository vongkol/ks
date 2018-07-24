@extends("layouts.customer")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Shop Detail</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/shop')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a> | <a href="{{url('/admin/shop/edit/'.$shop->id)}}" class="text-danger"><i class="fa fa-pencil"></i> <b>Edit</b></a>
            <hr>
            <form class="form-horizontal">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="shop_owner" class="control-label col-sm-3 lb">Shop Owner </label>
                            <label class="control-label col-sm-9 lb">
                               :  {{$shop_owner->last_name}} {{$shop_owner->first_name}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="control-label col-sm-3 lb">Name</label>
                            <label class="control-label col-sm-9 lb">
                               : {{$shop->name}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="shop_category" class="control-label col-sm-3 lb">Shop Category</label>
                            <label class="control-label col-sm-9 lb">
                               : {{$shop_category->name}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="control-label col-sm-3 lb">Email</label>
                            <label class="control-label col-sm-9 lb">
                            : {{$shop->email}}
                         </label>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="control-label col-sm-3 lb">Phone</label>
                            <label class="control-label col-sm-9 lb">
                               : {{$shop->phone}}
                            </label>
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="address" class="control-label col-sm-3 lb">Address</label>
                            <label class="control-label col-sm-9 lb">
                                : {{$shop->address}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="website" class="control-label col-sm-3 lb">Website</label>
                            <label class="control-label col-sm-9 lb">
                                : {{$shop->website}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="logo" class="control-label col-sm-3 lb">Logo</label>
                            <div class="col-sm-9">
                                <img src="{{asset('uploads/shops/logo/'.$shop->logo)}}" alt="" width="150" id="preview">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <label class="control-label col-sm-12 lb"><strong>Description / Profile <hr></strong></label>
                <label class="control-label col-sm-12 lb">
                {!!$shop->description!!}
                </label>
                           
                        </p>
                       
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
            $("#menu_shop").addClass("current");
        })
    </script>
@endsection