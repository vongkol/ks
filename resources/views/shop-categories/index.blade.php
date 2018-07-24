@extends("layouts.customer")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Shop Category List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/shop-category/create')}}"><i class="fa fa-plus"></i> New</a>
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
                @foreach($shop_categories as $shop_category)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$shop_category->name}}</td>
                        <td>
                            <a href="{{url('/admin/shop-category/edit/'.$shop_category->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/shop-category/delete/'.$shop_category->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$shop_categories->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
          $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_shop_category").addClass("current");
        })
    </script>
@endsection