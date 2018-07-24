@extends("layouts.review")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Event Category List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/review-category/create')}}"><i class="fa fa-plus"></i> New</a>
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
                $i = 18 * ($pagex - 1) + 1;
                ?>
                @foreach($review_categories as $review_category)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$review_category->name}}</td>
                        <td>{{$review_category->parent_name}}</td>
                        <td><img src="{{asset('uploads/reviews/icon/'.$review_category->icon)}}" alt="" width="25"></td>
                        <td>
                            <a href="{{url('/admin/review-category/edit/'.$review_category->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/review-category/delete/'.$review_category->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$review_categories->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_review_category").addClass("current");
        })
    </script>
@endsection