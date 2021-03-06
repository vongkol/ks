@extends('layouts.setting')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <strong>New Page</strong>&nbsp;&nbsp;
            <a href="{{url('admin/page')}}" class="btn btn-link btn-sm">Back To List</a>
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
            <form action="{{url('admin/page/save')}}" class="form-horizontal" method="post">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="title" class="control-label col-lg-1 col-sm-2">
                        Title <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-sm-8">
                        <input type="text" required autofocus name="title" id="title" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="control-label col-lg-1 col-sm-2">
                        Description
                    </label>
                    <div class="col-lg-11 col-sm-10">
                        <textarea name="description" id="description" rows="6" class="form-control ckeditor">
                        </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-lg-1 col-sm-2">&nbsp;</label>
                    <div class="col-lg-6 col-sm-8">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-danger" type="reset">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
   
@endsection
@section('js')
<script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
   var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 
   $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_page").addClass("current");
        });
  CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
</script> 
@endsection