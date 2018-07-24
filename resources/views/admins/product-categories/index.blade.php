@extends("layouts.product")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Product Category List</strong>&nbsp;&nbsp;
            <a href="{{url('/product-category/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Icon</th>
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
                @foreach($product_categories as $product_category)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$product_category->name}}</td>
                        <td>{{$product_category->parent_name}}</td>
                        <td><img src="{{asset('product/icon/'.$product_category->icon)}}" alt="" width="50"></td>
                        <td>
                            <a class="btn btn-sm btn-success btn-flat" href="{{url('/product-category/edit/'.$product_category->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger btn-flat" href="{{url('/product-category/delete/'.$product_category->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$product_categories->links()}}
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