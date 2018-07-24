@extends("layouts.school")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>School Program List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/school-program/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Featured Image</th>
                    <th>Name</th>
                    <th>School</th>
                    <th>Program Category</th>
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
                @foreach($school_programs as $school_program)
                    <tr>
                        <td>{{$i++}}</td>
                        <td><img src="{{asset('uploads/school_programs/featured_image/small/'.$school_program->featured_image)}}" width="50" alt=""></td>
                        <td>{{$school_program->title}}</td>
                        <td>{{$school_program->school_id}}</td>
                        <td>{{$school_program->program_category}}</td>
                        <td>
                            <a href="{{url('/admin/school-program/detail/'.$school_program->id)}}" title="Detail"><i class="fa fa-eye"></i></a>
                            &nbsp;<a href="{{url('/admin/school-program/edit/'.$school_program->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/school-program/delete/'.$school_program->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$school_programs->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_school_program").addClass("current");
        })
    </script>
@endsection