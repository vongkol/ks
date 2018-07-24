@extends("layouts.review")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Review List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/review/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Featured Image</th>
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
                @foreach($reviews as $r)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <a href="{{url('/admin/review/detail/'.$r->id)}}">
                                {{$r->title}}
                            </a>
                        </td>
                        <td>{{$r->name}}</td>
                        <td><img src="{{asset('uploads/reviews/'.$r->featured_image)}}" alt="" width="36"></td>
                        <td>
                            <a href="{{url('/admin/review/edit/'.$r->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/review/delete/'.$r->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$reviews->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_review").addClass("current");
        })
    </script>
@endsection