@extends("layouts.product")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Edit Product Category</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/product-category')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/admin/product-category/update')}}" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$category->id}}">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" class="form-control" 
                                value="{{$category->name}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="parent" class="control-label col-sm-3 lb">Parent</label>
                            <div class="col-sm-9">
                                <select name="parent" id="parent" class="form-control">
                                    <option value="0"> </option>
                                    @foreach($categories as $c)
                                        <option value="{{$c->id}}" {{$c->id==$category->parent_id?'selected':''}}>{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="control-label col-sm-3 lb">Type</label>
                            <div class="col-sm-9">
                                <select name="type" id="type" class="form-control">
                                    <option value="General" {{$category->type=='General'?'selected':''}}>General</option>
                                    <option value="Baby"  {{$category->type=='Baby'?'selected':''}}>Baby</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="icon" class="control-label col-sm-3 lb">Icon <span class="text-danger">(64x64)</span></label>
                            <div class="col-sm-9">
                                <input type="file" value="" name="icon" id="icon" class="form-control" onchange="loadFile(event)">
                                <br>
                                <img src="{{asset('uploads/product-categories/'.$category->icon)}}" alt="" width="72" id="preview">
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
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_product_category").addClass("current");
        })
    </script>
@endsection