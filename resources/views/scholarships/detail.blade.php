@extends("layouts.school")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Scholarship Detail</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/scholarship')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a> |  <a href="{{url('/admin/scholarship/edit/'.$scholarship->id)}}" class="text-danger"><i class="fa fa-pencil"></i> <b>Edit</b></a>
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
                            <label for="title" class="control-label col-sm-3 lb">Title</label>
                            <label for="title" class="control-label col-sm-3 lb">
                              : {{$scholarship->title}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="school_id" class="control-label col-sm-3 lb">School </label>
                            <label class="control-label col-sm-9 lb">
                                : {{$school->name_khmer}}
                            </label>
                        </div>
                       
                    </div>
                    <div class="col-md-6">
                        <label for="featured_image" class="control-label col-md-3 lb" style="padding:0;">Featured Image</label>
                       
                            <img src="{{asset('uploads/scholarships/featured_image/small/'.$scholarship->featured_image)}}" alt="" width="250" id="preview">
          
                    </div>
                </div>
                <div class="row">
                    
                <label class="control-label col-sm-12 lb"><strong>Description</strong> <hr></label>
                <label class="control-label col-sm-12 lb">
                        {!!$scholarship->description!!}
                </label>
              
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#siderbar li a").removeClass("current");
        $("#menu_scholarship").addClass("current");
    });
    var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                           filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                           removeDialogTabs: 'link:upload;image:upload'});
</script>
@endsection