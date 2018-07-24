@extends("layouts.school")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>School List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/school/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Logo</th>
                    <th>Khmer Name</th>
                    <th>English Name</th>
                    <th>Category</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
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
                @foreach($schools as $school)
                    <tr>
                        <td>{{$i++}}</td>
                        <td> @if($school->logo !== null)
                            <img src="{{asset('uploads/schools/logo/'.$school->logo)}}" alt="" width="50">
                            @else 
                            <img src="{{asset('uploads/schools/icon/default.png')}}" alt="" width="50">
                            @endif
                        </td>
                        <td>{{$school->name_khmer}}</td>
                        <td>{{$school->name_english}}</td>
                        <td>{{$school->school_category}}</td>
                        <td>{{$school->phone}}</td>
                        <td>{{$school->email}}</td>
                        <td>{{$school->address}}</td>
                        <td>
                            <a href="{{url('/admin/school/detail/'.$school->id)}}" title="Detail"><i class="fa fa-eye"></i></a>
                            &nbsp;<a href="{{url('/admin/school/edit/'.$school->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/school/delete/'.$school->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$schools->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_school").addClass("current");
        })
    </script>
@endsection