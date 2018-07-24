@extends("layouts.school")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>School Category List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/school-category/create')}}"><i class="fa fa-plus"></i> New</a>
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
                @foreach($school_categories as $school_category)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$school_category->name}}</td>
                        <td>{{$school_category->parent_name}}</td>
                        <td> @if($school_category->icon !== null)
                                    <img src="{{asset('uploads/schools/icon/'.$school_category->icon)}}" alt="" width="25">
                                @else
                                    <img src="{{asset('uploads/schools/icon/default.png')}}" alt="" width="25">
                                @endif</td>
                        <td>
                            <a href="{{url('/admin/school-category/edit/'.$school_category->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/school-category/delete/'.$school_category->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="text-danger fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$school_categories->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_school_category").addClass("current");
        })
    </script>
@endsection