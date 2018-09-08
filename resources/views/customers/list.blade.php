@extends("layouts.customer")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Customer List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/customer/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Username</th>
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
                @foreach($customers as $c)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$c->first_name}}</td>
                        <td>{{$c->last_name}}</td>
                        <td>{{$c->gender}}</td>
                        <td>{{$c->email}}</td>
                        <td>{{$c->phone}}</td>
                        <td>{{$c->username}}</td>
                        <td>
                            <a href="{{url('/admin/customer/reset/'.$c->id)}}" title="Reset Password"><i class="fa fa-key"></i></a>
                            &nbsp;<a href="{{url('/admin/customer/edit/'.$c->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/customer/delete/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_customer").addClass("current");
        })
    </script>
@endsection