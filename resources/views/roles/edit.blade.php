@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <strong>Edit Role</strong>&nbsp;&nbsp;
            <a href="{{url('/role/create')}}"><i class="fa fa-plus"></i> New</a>
            <a href="{{url('/role')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/role/update')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save?')">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="name" class="control-label col-sm-2 lb">Role Name <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="{{$role->name}}" id="name" name="name" required>
                        <input type="hidden" name="id" value="{{$role->id}}">
                        <br>
                        <button class="btn btn-primary btn-flat" type="submit">Save Changes</button>
                        <button class="btn btn-danger btn-flat" type="button" onclick="location.reload()">Cancel</button>
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
            $("#role").addClass("current");
        });
    </script>

@endsection