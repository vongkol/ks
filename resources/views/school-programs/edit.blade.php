@extends("layouts.school")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Edit School Program</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/school-program')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/admin/school-program/update')}}" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
                {{csrf_field()}}
                <input type="hidden" value="{{$school_program->id}}" name="id">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="title" class="control-label col-sm-3 lb">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$school_program->title}}" id="title" name="title" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="school_id" class="control-label col-sm-3 lb">School <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="school_id" id="school_id" class="form-control sl" required>
                                    @foreach($schools as $school)
                                        <option value="{{$school->id}}" {{$school->id==$school_program->school_id? 'selected': ''}}>{{$school->name_khmer}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="program_category" class="control-label col-sm-3 lb">Program Category <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="program_category" id="program_category" class="form-control sl" required>
                                    @foreach($program_categories as $pc)
                                        <option value="{{$pc->id}}" {{$school_program->program_category==$pc->id?'selected':''}}>{{$pc->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">

                        <label for="featured_image" class="control-label col-md-2 lb" style="padding:0;">Featured Image <span class="text-danger">(1200x600)</span></label>
                        <div class="col-md-10">
                            <input type="file" name="featured_image" id="featured_image" onchange="loadFile(event)" class="form-control" required onchange="loadFile(event)">
                            <br><img src="{{asset('uploads/school_programs/featured_image/small/'.$school_program->featured_image)}}" alt="" width="100" id="preview">
                        </div>
                       
                    </div>
                </div>
               
                        <div class="col-sm-12">
                            <p><strong>Description</strong></p>
                            <textarea name="description" id="description" cols="30" rows="10">{!!$school_program->description!!}</textarea>
                            <p></p>
                            <p>
                                <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                            </p>
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
        $("#menu_school_program").addClass("current");
    });
    var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

    CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                       filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                       removeDialogTabs: 'link:upload;image:upload'});
</script>
@endsection