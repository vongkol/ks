@extends("layouts.company")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Business Type List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/business-type/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $pagex = @$_GET['page'];
                if(!$pagex)
                    $pagex = 1;
                $i = 12 * ($pagex - 1) + 1;
                ?>
                @foreach($business_types as $business_type)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$business_type->name}}</td>
                        <td>
                            <a href="{{url('/admin/business-type/edit/'.$business_type->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/business-type/delete/'.$business_type->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$business_types->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_business_type").addClass("current");
        })
    </script>
@endsection