@extends("layouts.customer")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Transfer Category List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/transfer-category/create')}}"><i class="fa fa-plus"></i> New</a>
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
                @foreach($transfers_categories as $tc)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$tc->name}}</td>
                        <td>
                            <a href="{{url('/admin/transfer-category/edit/'.$tc->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/transfer-category/delete/'.$tc->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$transfers_categories->links()}}
            </nav>
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