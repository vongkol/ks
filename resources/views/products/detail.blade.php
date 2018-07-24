@extends("layouts.product")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Product Detail</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/product')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>&nbsp;&nbsp;
            <a href="{{url('/admin/product/edit/'.$product->id)}}" class="text-danger"><i class="fa fa-pencil"></i> Edit</a>
            <hr>
           
            <form action="#" method="post" id="frm" class="form-horizontal">
                <input type="hidden" name="id" value="{{$product->id}}">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="name" class="control-label col-sm-3 lb">Product Name</label>
                            <label class="control-label col-sm-9 lb">
                                : {{$product->name}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="control-label col-sm-3 lb">Category</label>
                            <label class="control-label col-sm-9 lb">
                                : {{$product->cname}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 lb">Product Type</label>
                            <label class="control-label col-sm-9 lb">
                                : {{$product->type}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 lb">Shop Name</label>
                            <label class="control-label col-sm-9 lb">
                                : {{$product->sname}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="short_description" class="control-label col-sm-3 lb">Short Description</label>
                            <label class="control-label col-sm-9 lb">
                                : {{$product->short_description}}
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                       
                        <div class="form-group row">
                            <label for="photo" class="control-label col-sm-3 lb">Featured Photo  <span class="text-danger">(500 x 400)</span></label>
                            <div class="col-sm-9">
                               
                                <img src="{{asset('uploads/products/featured/'.$product->featured_image)}}" alt="" width="200" style="border:1px solid #ccc" id="preview">
                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="quantity" class="control-label col-sm-3 lb">Quantity</label>
                            <label class="control-label col-sm-9 lb">
                                : {{$product->quantity}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="control-label col-sm-3 lb">Unit Price</label>
                            <label class="control-label col-sm-9 lb">
                                : $ {{$product->price}} 
                            </label>
                        </div>
                        
                        <div class="form-group row">
                            <label for="sell_price" class="control-label col-sm-3 lb">Sell Price</label>
                            <label class="control-label col-sm-9 lb">
                                : $ {{$product->sell_price}}
                            </label>
                        </div>
                       
                    </div>
                </div>
            </form>
                <div class="row">
                    <div class="col-sm-12">
                        <p><strong>Description</strong></p>
                        <label class="control-label col-sm-9 lb">
                                {!! $product->description !!}
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="text-success">Product Photos</h3>
                        <div>
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
                        </div>
                        <div>
                            <form action="{{url('/admin/product/photo/save')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <p></p>
                                <p><strong>Upload Photo</strong></p>
                                <hr>
                                <div class="form-group row">
                                    <label for="title" class="control-label col-sm-2 lb">Title</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="title">
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="photo" class="control-label col-sm-2 lb">Photo <span class="text-danger">(500 x 400)</span></label>
                                    <div class="col-sm-5">
                                        <input type="file" class="form-control" id="photo" name="photo">
                                    </div>
                                    <div class="col-sm-1">
                                        <button class="btn btn-primary" type="submit">Upload</button>
                                    </div>
                                </div>
                                <p></p>
                            </form>

                        </div>
                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>Photo</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($photos as $p)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        <img src="{{asset('uploads/products/500/'.$p->photo)}}" alt="" width="100">
                                    </td>
                                    <td>{{$p->title}}</td>
                                    <td>
                                        <a href="{{url('admin/product/photo/delete/'.$p->id . '?pid='.$product->id)}}" onclick="return confirm('You want to delete?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            <br>
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
       
    </script>
@endsection