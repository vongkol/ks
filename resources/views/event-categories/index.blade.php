@extends("layouts.event")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Event Category List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/event-category/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Parent</th>
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
                @foreach($event_categories as $event_category)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$event_category->name}}</td>
                        <td><img src="{{asset('uploads/events/icon/'.$event_category->icon)}}" alt="" width="25"></td>
                        <td>{{$event_category->parent_name}}</td>
                        <td>
                            <a href="{{url('/admin/event-category/edit/'.$event_category->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/event-category/delete/'.$event_category->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$event_categories->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_event_category").addClass("current");
        })
    </script>
@endsection