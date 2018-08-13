@extends("layouts.business")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Business Transfer List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/business-transfer/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Featured Image</th>
                    <th>Title</th>
                    <th>Short Descritpion</th>
                    <th>Category</th>
                    <th>Shop Owner</th>
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
                @foreach($business_transfers as $b)
                    <tr>
                        <td>{{$i++}}</td>
                        <td><img src="{{asset('uploads/business_transfers/'.$b->featured_image)}}" alt="" width="50"></td>
                        <td>{{$b->title}}</td>
                        <td>{{$b->short_description}}</td>
                        <td>{{$b->name}}</td>
                        <td>{{$b->first_name}} {{$b->last_name}}</td>
                        <td>
                            <a href="{{url('/admin/business-transfer/detail/'.$b->id)}}" title="Detail"><i class="fa fa-eye"></i></a>
                            &nbsp;<a href="{{url('/admin/business-transfer/edit/'.$b->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a  href="{{url('/admin/business-transfer/delete/'.$b->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$business_transfers->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_business_transfer").addClass("current");
        })
    </script>
@endsection