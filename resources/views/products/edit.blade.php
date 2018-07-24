@extends("layouts.product")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Edit Product</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/product')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/admin/product/update')}}" method="post" id="frm" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$product->id}}">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="name" class="control-label col-sm-3 lb">Product Name<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" class="form-control" autofocus required 
                                value="{{$product->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="control-label col-sm-3 lb">Category<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                               <select name="category" id="category" class="form-control">
                                    @foreach($categories as $c)
                                        <option value="{{$c->id}}" {{$product->category_id==$c->id?'selected':''}}>{{$c->name}}</option>
                                    @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="control-label col-sm-3 lb">Product Type<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="type" id="type" class="form-control">
                                    <option value="General" {{$product->type=='General'?'selected':''}}>General</option>
                                    <option value="Baby" {{$product->type=='Baby'?'selected':''}}>Baby</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shop" class="control-label col-sm-3 lb">Shop Name<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="shop" id="shop" class="form-control">
                                    @foreach($shops as $s)
                                        <option value="{{$s->id}}" {{$product->shop_id==$s->id?'selected':''}}>{{$s->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="quantity" class="control-label col-sm-3 lb">Quantity<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                               <input type="number" class="form-control" id="quantity" name="quantity" min="0" max="9999" step="1" value="{{$product->quantity}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="control-label col-sm-3 lb">Price<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                               <input type="number" class="form-control" id="price" name="price" min="0" max="9999" step="0.1" 
                               value="{{$product->price}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sell_price" class="control-label col-sm-3 lb">Sell Price<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                               <input type="number" class="form-control" id="sell_price" name="sell_price" min="0" max="9999" step="0.1" value="{{$product->sell_price}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="short_description" class="control-label col-sm-3 lb">Short Description</label>
                            <div class="col-sm-9">
                                <textarea name="short_description" id="short_description" cols="30" rows="3" class="form-control">{{$product->short_description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="photo" class="control-label col-sm-3">Featured Photo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="photo" name="photo" onchange="loadFile(event)">
                                <span class="text-danger">(500 x 400)</span>
                                <div>
                                    <img src="{{asset('uploads/products/featured/'.$product->featured_image)}}" alt="" width="200" style="border:1px solid #ccc" id="preview">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p><strong>Description</strong></p>
                        <textarea name="description" id="description" cols="30" rows="10" required>{{$product->description}}</textarea>
                        <p></p>
                        <p>
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
            $("#menu_product").addClass("current");
        });
        var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

  CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
    </script>
@endsection