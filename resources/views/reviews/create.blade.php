@extends("layouts.review")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Create New Review</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/review')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/admin/review/save')}}" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="title" class="control-label col-sm-3 lb">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="title" name="title" class="form-control" required value="{{old('title')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="control-label col-sm-3 lb">Category <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="category" id="category" class="form-control">
                                    @foreach($categories as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="control-label col-sm-3 lb">Featured Image <span class="text-danger">(250x180)</span></label>
                            <div class="col-sm-9">
                                <input type="file" value="" name="photo" id="photo" class="form-control" onchange="loadFile(event)">
                                <br>
                                <img src="" alt="" width="70" id="preview">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label class="control-label col-sm-3 lb"></label>
                            <div class="col-sm-9">
                                <p></p>
                                <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                         <p><strong>Content Page 1</strong></p>
                        
                    </div>                       
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <textarea name="description1" id="description1" cols="30" rows="10" class="form-control">{{old('description1')}}</textarea>
                        
                    </div>
                </div>
                <div class="row">
                        <div class="col-sm-12">
                            <p></p>
                             <p><strong>Content Page 2</strong></p>
                            
                        </div>                       
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <textarea name="description2" id="description2" cols="30" rows="10" class="form-control">{{old('description2')}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p></p>
                            <p>
                                <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                <button class="btn btn-danger btn-flat" type=" reset">Cancel</button>
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
            $("#menu_review").addClass("current");
        });
        var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

        CKEDITOR.replace( 'description1',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
        CKEDITOR.replace( 'description2',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
    </script>
@endsection