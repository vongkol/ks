@extends("layouts.customer")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Shop Owner List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/shop-owner/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Photo</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>username</th>
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
                @foreach($shop_owners as $shop_owner)
                    <tr>
                        <td>{{$i++}}</td>
                        <td><img src="{{asset('uploads/shop_owners/profile/'.$shop_owner->photo)}}" alt="" width="50"></td>
                        <td>{{$shop_owner->first_name}}</td>
                        <td>{{$shop_owner->last_name}}</td>
                        <td>{{$shop_owner->gender}}</td>
                        <td>{{$shop_owner->email}}</td>
                        <td>{{$shop_owner->phone}}</td>
                        <td>{{$shop_owner->username}}</td>
                        <td>
                            <a href="{{url('/admin/shop-owner/reset-password/'.$shop_owner->id)}}" title="Reset Password"><i class="fa fa-key text-warning"></i></a>
                            &nbsp;<a href="{{url('/admin/shop-owner/detail/'.$shop_owner->id)}}" title="Detail"><i class="fa fa-eye"></i></a>
                            &nbsp;<a href="{{url('/admin/shop-owner/edit/'.$shop_owner->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/shop-owner/delete/'.$shop_owner->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$shop_owners->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_shop_owner").addClass("current");
        })
    </script>
@endsection