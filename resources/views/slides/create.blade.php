@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Create New Slide</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/slide')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/admin/slide/save')}}" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
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
                            <label for="short_description" class="control-label col-sm-3 lb">Short Description</label>
                            <div class="col-sm-9">
                                <textarea name="short_description" id="short_description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="order" class="control-label col-sm-3 lb">Order</label>
                            <div class="col-sm-9">
                                <input type="number" id="order" name="order" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url" class="control-label col-sm-3 lb">Link URL</label>
                            <div class="col-sm-9">
                                <input type="text" id="url" name="url" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="control-label col-sm-3 lb">Photo <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="file" value="" required name="photo" id="photo" class="form-control" onchange="loadFile(event)">
                                <br>
                                <img src="{{asset('uploads/slides/image/default.png')}}" alt="" width="72" id="preview">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label class="control-label col-sm-3 lb"></label>
                            <div class="col-sm-9">
                                <p></p>
                                <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_slide_show").addClass("current");
        })
    </script>
@endsection