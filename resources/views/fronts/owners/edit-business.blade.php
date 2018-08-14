@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">
            <p></p>
            <h3 class="text-primary">Edit Business Transfer <a href="{{url('/owner/business-transfer')}}" class="btn btn-success btn-xs">Back</a></h3>
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
            <form action="{{url('/owner/business/update')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-7">
                   
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$business->id}}">
                        <div class="form-group row">
                            <label for="title" class="control-label col-sm-3">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="title" value="{{$business->title}}" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="control-label col-sm-3">Category <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="category" id="category" class="form-control">
                                    @foreach($categories as $c)
                                        <option value="{{$c->id}}" {{$business->category_id==$c->id?'selected':''}}>{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Short Description</label>
                            <div class="col-sm-9">
                                <textarea name="short_description" id="short_description" cols="30" rows="3" class="form-control">{{$business->short_description}}</textarea>
                            </div>
                        </div>
                </div>
                <div class="col-sm-5">
                    <h4>Featured Image</h4>
                    <img src="{{asset('uploads/business_transfers/'.$business->featured_image)}}" alt="Photo" width="130" id="img">
                    <p></p>
                    <p>
                        <input type="file" name="photo" onchange="loadFile(event)">
                    </p>
                </div>
            </div>
            <div class="row">
                <h4>Description</h4>
                
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$business->description}}</textarea>
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