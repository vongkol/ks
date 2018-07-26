@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">
            <p></p>
            <h3 class="text-primary">Create New Shop</h3>
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
            <form action="{{url('/owner/shop/save')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-7">
                   
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Shop Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{old('name')}}" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Category <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="category" id="category" class="form-control">
                                    @foreach($categories as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Website</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="website" value="{{old('website')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone" value="{{old('phone')}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address" value="{{old('address')}}">
                            </div>
                        </div>
                </div>
                <div class="col-sm-5">
                    <h4>Shop Logo</h4>
                    <img src="{{asset('uploads/shops/logo/default.png')}}" alt="Photo" width="130" id="img">
                    <p></p>
                    <p>
                        <input type="file" name="logo" onchange="loadFile(event)">
                    </p>
                </div>
            </div>
            <div class="row">
                <h4>Shop Description</h4>
                
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
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