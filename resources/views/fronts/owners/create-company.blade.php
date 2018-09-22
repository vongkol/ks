@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">
            <p></p>
            <h3 class="text-primary">Create New Company <a href="{{url('/owner/company')}}" class="btn btn-success btn-xs">Back</a></h3>
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
            <form action="{{url('/owner/company/save')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-7">
                   
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="name" class="control-label col-sm-3">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{old('name')}}" autofocus required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="business_type" class="control-label col-sm-3">Business Type <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="business_type" id="business_type" class="form-control">
                                    @foreach($business_types as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="control-label col-sm-3">Categroy <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="category" id="category" class="form-control">
                                    @foreach($categories as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="control-label col-sm-3">Address</label>
                            <div class="col-sm-9">
                                <input type="text" name="address"  value="{{old('address')}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="office_phone" class="control-label col-sm-3">Office Phone</label>
                            <div class="col-sm-9">
                                <input type="text" name="office_phone"  value="{{old('office_phone')}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="office_email" class="control-label col-sm-3">Office Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="example@gmail.com"  name="office_email" value="{{old('office_email')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="website" class="control-label col-sm-3">Website</label>
                            <div class="col-sm-9">
                                <input type="text" name="website"  value="{{old('website')}}" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="col-sm-5">
                    <h4>Logo <span class="text-danger">(150x150)</span></h4>
                    <img src="{{asset('uploads/companies/logo/default.png')}}" alt="Photo" width="130" id="img">
                    <p></p>
                    <p>
                        <input type="file" name="logo" onchange="loadFile(event)">
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4>Company Profile</h4>
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