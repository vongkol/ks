@extends("layouts.event")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Event List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/event/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Feature Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Organizor</th>
                    <th>Event Date</th>
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
                @foreach($events as $event)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
            
                        <img src="{{asset('uploads/events/featured_image/small/'.$event->featured_image)}}" width="50" alt=""></td>
                            
                        <td>{{$event->title}}</td>
                        <td>{{$event->event_category}}</td>
                        <td>{{$event->location}}</td>
                        <td>{{$event->event_organizor}}</td>
                        <td>{{$event->event_date}}</td>
                        <td>
                            <a href="{{url('/admin/event/detail/'.$event->id)}}" title="Detail"><i class="fa fa-eye"></i></a>
                            &nbsp;<a href="{{url('/admin/event/edit/'.$event->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/event/delete/'.$event->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$events->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_event").addClass("current");
        })
    </script>
@endsection