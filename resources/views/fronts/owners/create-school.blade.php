@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">
            <p></p>
            <h3 class="text-primary">Create New School <a href="{{url('/owner/school')}}" class="btn btn-success btn-xs">Back</a></h3>
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
            <form action="{{url('/owner/school/save')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-7">
                   
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="name_khmer" class="control-label col-sm-3">Khmer Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name_khmer" value="{{old('name_khmer')}}" autofocus required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name_english" class="control-label col-sm-3">English Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name_english" value="{{old('name_english')}}"  class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">School Category <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="category" id="category" class="form-control">
                                    @foreach($categories as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="control-label col-sm-3">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone"  value="{{old('phone')}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="control-label col-sm-3">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="example@gmail.com"  name="email" value="{{old('email')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="control-label col-sm-3">Address</label>
                            <div class="col-sm-9">
                                <input type="texxt" name="address"  value="{{old('address')}}" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="col-sm-5">
                    <h4>Logo <span class="text-danger">(150x150)</span></h4>
                    <img src="{{asset('uploads/schools/logo/default.png')}}" alt="Photo" width="130" id="img">
                    <p></p>
                    <p>
                        <input type="file" name="logo" onchange="loadFile(event)">
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4>School Profile</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <textarea name="profile" id="profile" cols="30" rows="10" class="form-control"></textarea>
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

  CKEDITOR.replace( 'profile',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
    </script>
@endsection