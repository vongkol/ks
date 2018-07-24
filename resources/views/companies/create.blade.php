@extends("layouts.company")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Create New Company</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/company')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/admin/company/save')}}" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="business_type" class="control-label col-sm-3 lb">Business Type </label>
                            <div class="col-sm-9">
                                <select name="business_type" id="business_type" class="form-control sl">
                                    @foreach($business_types as $business_type)
                                        <option value="{{$business_type->id}}">{{$business_type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="control-label col-sm-3 lb">Address</label>
                            <div class="col-sm-9">
                                <input type="text" id="address" name="address" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="office_phone" class="control-label col-sm-3 lb">Office Phone</label>
                            <div class="col-sm-9">
                                <input type="text" id="office_phone" name="office_phone" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="office_email" class="control-label col-sm-3 lb">Office Email</label>
                            <div class="col-sm-9">
                                <input type="email" id="office_email" name="office_email" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                            <div class="form-group row">
                                    <label for="company" class="control-label col-sm-3 lb">Company Category</label>
                                    <div class="col-sm-9">
                                        <select name="company" id="company" class="form-control sl">
                                            @foreach($categories as $c)
                                                <option value="{{$c->id}}">{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            <div class="form-group row">
                                    <label for="website" class="control-label col-sm-3 lb">Website URL</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="website" name="website" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="logo" class="control-label col-sm-3 lb">Logo</label>
                                    <div class="col-sm-9">
                                        <input type="file" value="" name="logo" id="logo" class="form-control" onchange="loadFile(event)">
                                        <br>
                                        <img src="{{asset('uploads/companies/icon/default.png')}}" alt="" width="72" id="preview">
                                    </div>
                                </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p><strong>Company Profile</strong></p>
                        <textarea name="profile" id="profile" cols="30" rows="10"></textarea>
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
            $("#menu_company").addClass("current");
        });
        var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

  CKEDITOR.replace( 'profile',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
    
    </script>
@endsection