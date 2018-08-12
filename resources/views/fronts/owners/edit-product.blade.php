@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">
            <p></p>
            <h3 class="text-primary">Edit Product <a href="{{url('/owner/product')}}" class="btn btn-success btn-xs">Back</a></h3>
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
            <form action="{{url('/owner/product/update')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-7">
                    <input type="hidden" name="id" value="{{$product->id}}">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Product Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{$product->name}}" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Product Category <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="category" id="category" class="form-control">
                                    @foreach($categories as $c)
                                        <option value="{{$c->id}}" {{$product->category_id==$c->id?'selected':''}}>{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Product Type <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="type" id="type" class="form-control">
                                   <option value="General" {{$product->type=='General'?'selected':''}}>General</option>
                                   <option value="Baby" {{$product->type=='Baby'?'selected':''}}>Baby</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Quantity</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="quantity" value="{{$product->quantity}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Price <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="texxt" name="price" value="{{$product->price}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Sale Price <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="sell_price" value="{{$product->sell_price}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Short Description</label>
                            <div class="col-sm-9">
                                <textarea name="short_description" id="short_description" cols="30" rows="3" class="form-control">{{$product->short_description}}</textarea>
                            </div>
                        </div>
                </div>
                <div class="col-sm-5">
                    <h4>Featured Image</h4>
                    <img src="{{asset('uploads/products/featured/'.$product->featured_image)}}" alt="Photo" width="130" id="img">
                    <p></p>
                    <p>
                        <input type="file" name="photo" onchange="loadFile(event)">
                    </p>
                </div>
            </div>
            <div class="row">
                <h4>Product Description</h4>
                
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$product->description}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p></p>
                    <button class="btn btn-primary btn-xs" type="submit">Save</button>
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
            var output = document.getElementById('img');
            
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

  CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
    </script>
@endsection