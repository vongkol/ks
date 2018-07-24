@extends("layouts.review")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Edit Review Category</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/review-category')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/admin/review-category/update')}}" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$review_category->id}}">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" class="form-control" value="{{$review_category->name}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="parent_id" class="control-label col-sm-3 lb">Parent </label>
                            <div class="col-sm-9">
                                <select name="parent_id" id="parent_id" class="form-control sl">
                                        <option value="0"> </option>
                                    @foreach($review_categories as $rc)
                                        <option value="{{$rc->id}}" {{$review_category->parent_id==$rc->id?'selected': ''}}>{{$rc->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="icon" class="control-label col-sm-3 lb">Icon <span class="text-danger">(25x25)</span></label>
                            <div class="col-sm-9">
                                <input type="file"  name="icon" id="icon" class="form-control" onchange="loadFile(event)">
                                <br>
                                <img src="{{asset('uploads/reviews/icon/'.$review_category->icon)}}" alt="" width="72" id="preview">
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
            $("#menu_review_category").addClass("current");
        })
    </script>
@endsection