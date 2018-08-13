@extends("layouts.customer")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Edit Transfer Category</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/transfer-category')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/admin/transfer-category/update')}}" method="post" id="frm" class="form-horizontal">
                {{csrf_field()}}
                <input type="hidden" value="{{$transfer_category->id}}" name="id">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$transfer_category->name}}" id="name" name="name" class="form-control" required>
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
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_transfer_category").addClass("current");
        })
    </script>
@endsection