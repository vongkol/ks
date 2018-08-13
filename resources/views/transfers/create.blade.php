@extends("layouts.business")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Create New Business Transfer</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/transfer')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/admin/business-transfer/save')}}" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="title" class="control-label col-sm-3 lb">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="title" name="title" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="transfer_categroy" class="control-label col-sm-3 lb">Transfer Category </label>
                            <div class="col-sm-9">
                                <select name="transfer_categroy" id="transfer_categroy" class="form-control sl">
                                    @foreach($transfers_categories as $tc)
                                        <option value="{{$tc->id}}">{{$tc->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="short_description" class="control-label col-sm-3 lb">Short Description</label>
                            <div class="col-sm-9">
                                <textarea name="short_description" id="short_description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="featured_image" class="control-label col-sm-3 lb">Featured Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" value="" name="featured_image" id="featured_image" class="form-control" onchange="loadFile(event)">
                                        <br>
                                        <img src="" alt="" width="72" id="preview">
                                    </div>
                                </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p><strong>Description</strong></p>
                        <textarea name="description" id="description" cols="30" rows="10"></textarea>
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

  CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
    
    </script>
@endsection