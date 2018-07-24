@extends("layouts.school")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>School Detail</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/school')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a> |  <a href="{{url('/admin/school/edit/'.$school->id)}}" class="text-danger"><i class="fa fa-pencil"></i><b> Edit</b></a> 
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
            <form class="form-horizontal">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="name_khmer" class="control-label col-sm-3 lb">Khmer Name</label>
                            <label class="control-label col-sm-9 lb">
                               : {{$school->name_khmer}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="school_category" class="control-label col-sm-3 lb">School Category</label>
                            <label class="control-label col-sm-9 lb">
                                : {{$school_category->name}}
                            </label>
                        </div>
                        <div class="form-group row">
                                <label for="email" class="control-label col-sm-3 lb">Email</label>
                                <label class="control-label col-sm-9 lb">
                                    : {{$school->email}}
                                </label>
                            </div>
                        <div class="form-group row">
                            <label for="phone" class="control-label col-sm-3 lb">Phone</label>
                            <label class="control-label col-sm-9 lb">
                               : {{$school->phone}}
                            </label>
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="name_english" class="control-label col-sm-3 lb">English Name</label>
                            <label class="control-label col-sm-9 lb">
                               : {{$school->name_english}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="control-label col-sm-3 lb">Address</label>
                            <label class="control-label col-sm-9 lb">
                                : {{$school->address}}
                            </label>
                        </div>
                        
                        <div class="form-group row">
                            <label for="logo" class="control-label col-sm-3 lb">Logo</label>
                            <label class="control-label col-sm-9 lb">
                                @if($school->logo !== null)
                                <img src="{{asset('uploads/schools/logo/'.$school->logo)}}" alt="" width="150" id="preview">
                                @else
                                <img src="{{asset('uploads/schools/icon/default.png')}}" alt="" width="150" id="preview">
                                @endif
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                
                    <label class="control-label col-sm-12 lb">
                        <p><strong>School Profile</strong></p><hr>
                        
                            {!!$school->profile!!}
                       <hr>
                    </label>
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