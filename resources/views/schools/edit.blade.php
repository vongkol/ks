@extends("layouts.school")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Edit School</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/school')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/admin/school/update')}}" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$school->id}}">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="name_khmer" class="control-label col-sm-3 lb">Khmer Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="name_khmer" value="{{$school->name_khmer}}" name="name_khmer" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name_english" class="control-label col-sm-3 lb">English Name</label>
                            <div class="col-sm-9">
                                <input type="text" id="name_english" value="{{$school->name_english}}" name="name_english" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="email" class="control-label col-sm-3 lb">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" id="email" name="email" value="{{$school->email}}" class="form-control">
                                </div>
                            </div>
                       
                        
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group row">
                            <label for="phone" class="control-label col-sm-3 lb">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" id="phone" value="{{$school->phone}}" name="phone" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="school_category" class="control-label col-sm-3 lb">School Category</label>
                            <div class="col-sm-9">
                                <select name="school_category" id="school_category" class="form-control sl">
                                    @foreach($school_categories as $school_category)
                                        <option value="{{$school_category->id}}" {{$school->school_category==$school_category->id? "selected": ''}}>{{$school_category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="control-label col-sm-3 lb">Address</label>
                            <div class="col-sm-9">
                                <input type="text" id="address" name="address" value="{{$school->address}}" class="form-control">
                            </div>
                        </div>
                       
                       
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <label class="control-label lb"><strong>School Profile</strong></label>
                        <textarea name="profile" id="profile" cols="30" rows="10">{{$school->profile}}</textarea>
                    </div>
                <div class="col-md-3">
                <label for="logo" class="control-label lb"><b>Logo</b> <span class="text-danger">(150 x 150)</span></label>
                     
                            <input type="file" name="logo" id="logo" class="form-control" onchange="loadFile(event)">
                            <br>
                            <img src="{{asset('uploads/schools/logo/'.$school->logo)}}" alt="" width="150" id="preview">
                      
              
                    </div>
                       
                </div>
                <div class="row">
                        <div class="col-sm-12">
                           
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
        $("#menu_school").addClass("current");
    });
    var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

CKEDITOR.replace( 'profile',{filebrowserBrowseUrl:roxyFileman, 
                         filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                         removeDialogTabs: 'link:upload;image:upload'});
</script>

@endsection