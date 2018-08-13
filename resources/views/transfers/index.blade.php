@extends("layouts.business")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>School List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/transfer/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Image</th>
                   
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_transfer").addClass("current");
        })
    </script>
@endsection