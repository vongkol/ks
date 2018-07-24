@extends("layouts.customer")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Create New Shop</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/shop')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/admin/shop/save')}}" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="shop_owner" class="control-label col-sm-3 lb">Shop Owner <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                               <select name="shop_owner" class="form-control" id="shop_owner">
                                   @foreach($shop_owners as $shop_owner)
                                   <option value="{{$shop_owner->id}}">{{$shop_owner->first_name}} {{$shop_owner->last_name}}</option>
                                   @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" value="{{old('name')}}" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shop_category" class="control-label col-sm-3 lb">Shop Category<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                               <select name="shop_category" style="margin-top: 10px;"  class="form-control" id="shop_category">
                                   @foreach($shop_categories as $shop_category)
                                   <option value="{{$shop_category->id}}">{{$shop_category->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="control-label col-sm-3 lb">Email</label>
                            <div class="col-sm-9">
                                <input type="email" id="email" value="{{old('email')}}" name="email" class="form-control"​>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="control-label col-sm-3 lb">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone" value="{{old('phone')}}" id="phone" class="form-control">
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="col-sm-6">
                            <div class="form-group row">
                                    <label for="address" class="control-label col-sm-3 lb">Address</label>
                                    <div class="col-sm-9">
                                        <textarea name="address" id="address" class="form-control">{{old('address')}}</textarea>
                                    </div>
                                </div>
                                
                            <div class="form-group row">
                                    <label for="website" class="control-label col-sm-3 lb">Website</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="website" value="{{old('website')}}" id="website" class="form-control">
                                    </div>
                                </div>
                            <div class="form-group row">
                                    <label for="logo" class="control-label col-sm-3 lb">Logo </label>
                                    <div class="col-sm-9">
                                        <input type="file" value="" name="logo" id="logo" class="form-control" onchange="loadFile(event)"><span class="text-danger">(150 x 150)</span>
                                        <br>
                                        <img src="{{asset('uploads/shops/logo/default.png')}}" alt="" width="72" id="preview">
                                    </div>
                                </div>
                                
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <strong>Description / Profile</strong>
                        <div>
                            <textarea name="description" id="description" rows="8"></textarea>
                        </div>
                        <p>
                                <p></p>
                                <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                        </p>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_shop").addClass("current");
        });
        var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                             filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                             removeDialogTabs: 'link:upload;image:upload'});

    </script>
@endsection