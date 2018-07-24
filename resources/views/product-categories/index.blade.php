@extends("layouts.product")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Product Category List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/product-category/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th>Type</th>
                    <th>Icon</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $pagex = @$_GET['page'];
                if(!$pagex)
                    $pagex = 1;
                $i = 18 * ($pagex - 1) + 1;
                ?>
                @foreach($categories as $c)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$c->name}}</td>
                        <td>{{$c->parent_name}}</td>
                        <td>{{$c->type}}</td>
                        <td><img src="{{asset('uploads/product-categories/'.$c->icon)}}" alt="" width="25"></td>
                        <td>
                            <a href="{{url('/admin/product-category/edit/'.$c->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/product-category/delete/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$categories->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_product_category").addClass("current");
        })
    </script>
@endsection