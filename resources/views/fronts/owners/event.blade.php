@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">
            <p></p>
            <h3 class="text-primary">My Event <a href="{{url('/owner/event/create')}}" class="btn btn-primary btn-xs">New</a></h3>
            <hr>
            @if(Session::has('sms'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('sms')}}
                    </div>
                </div>
            @endif
            @if(Session::has('sms1'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('sms1')}}
                    </div>
                </div>
            @endif
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Event ID</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Photo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>{{$p->title}}</td>
                        <td>$ {{$p->price}}</td>
                        <td>{{$p->cname}}</td>
                        <td>
                            <img src="{{asset('uploads/events/featured_image/small/'.$p->featured_image)}}" alt="Photo" width="70">
                        </td>
                        <td>
                            <a href="{{url('/owner/event/edit/'.$p->id)}}" class="btn btn-link text-success" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{url('/owner/event/delete/'.$p->id)}}" class="btn btn-link text-danger" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$events->links()}}
       </div>
   </div>
@endsection
