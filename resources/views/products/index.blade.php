@extends("layouts.product")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Product List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/product/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Sale Price</th>
                    <th>Category</th>
                    <th>Photo</th>
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
                @foreach($products as $c)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <a href="{{url('/admin/product/detail/'.$c->id)}}">{{$c->name}}</a>
                        </td>
                        <td>$ {{$c->price}}</td>
                        <td>$ {{$c->sell_price}}</td>
                        <td>{{$c->cname}}</td>
                        <td><img src="{{asset('uploads/products/featured/'.$c->featured_image)}}" alt="" width="25"></td>
                        <td>
                            <a href="{{url('/admin/product/detail/'.$c->id)}}" title="Detail"><i class="fa fa-eye"></i></a>&nbsp;
                            <a href="{{url('/admin/product/edit/'.$c->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/product/delete/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$products->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_product").addClass("current");
        })
    </script>
@endsection