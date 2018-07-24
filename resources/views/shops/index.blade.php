@extends("layouts.customer")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Shop List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/shop/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Shop Owner</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Website URL</th>
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
                @foreach($shops as $shop)
                    <tr>
                        <td>{{$i++}}</td>
                        <td><img src="{{asset('uploads/shops/logo/'.$shop->logo)}}" alt="" width="50"></td>
                        <td>{{$shop->name}}</td>
                        <td>{{$shop->shop_owner_first_name}}  {{$shop->shop_owner_last_name }}</td>
                        <td>{{$shop->email}}</td>
                        <td>{{$shop->phone}}</td>
                        <td>{{$shop->website}}</td>
                        <td>
                            <a href="{{url('/admin/shop/detail/'.$shop->id)}}" title="Detail"><i class="fa fa-eye"></i></a>
                            &nbsp;<a href="{{url('/admin/shop/edit/'.$shop->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/shop/delete/'.$shop->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$shops->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_shop").addClass("current");
        })
    </script>
@endsection