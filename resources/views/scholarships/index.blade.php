@extends("layouts.school")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Scholarship Program List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/scholarship/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Featured image</th>
                    <th>Name</th>
                    <th>School</th>
                    <th>Scholarship Category</th>
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
                @foreach($scholarships as $scholarship)
                    <tr>
                        <td>{{$i++}}</td>
                        <td><img src="{{asset('uploads/scholarships/featured_image/small/'.$scholarship->featured_image)}}" width="50" alt=""></td>
                        <td>{{$scholarship->title}}</td>
                        <td>{{$scholarship->school_id}}</td>
                        <td>{{$scholarship->scholarship_category}}</td>
                        <td>
                            <a  href="{{url('/admin/scholarship/detail/'.$scholarship->id)}}" title="Detail"><i class="fa fa-eye"></i></a>
                            &nbsp;<a href="{{url('/admin/scholarship/edit/'.$scholarship->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/scholarship/delete/'.$scholarship->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$scholarships->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_scholarship").addClass("current");
        })
    </script>
@endsection