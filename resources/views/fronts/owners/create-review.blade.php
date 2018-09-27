@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">
            <p></p>
            <h3 class="text-primary">Create New Review <a href="{{url('/owner/review')}}" class="btn btn-success btn-xs">Back</a></h3>
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
            <form action="{{url('/owner/review/save')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-7">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="title" class="control-label col-sm-3">Title <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="title" value="{{old('title')}}" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3">Category <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="category" id="category" class="form-control">
                                @foreach($categories as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <h4>Featured Image</h4>
                    <img src="{{asset('uploads/business_transfers/default.png')}}" alt="Photo" width="130" id="img">
                    <p></p>
                    <p>
                        <input type="file" name="featured_image" onchange="loadFile(event)">
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4>Description 1</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <textarea name="description1" id="description1" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4>Description 2</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <textarea name="description2" id="description2" cols="30" rows="10" class="form-control"></textarea>
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

        CKEDITOR.replace( 'description1',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
        CKEDITOR.replace( 'description2',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
    </script>
@endsection