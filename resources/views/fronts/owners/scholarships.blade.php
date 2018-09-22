@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">
            <p></p>
            <h3 class="text-primary">My Scholarship <a href="{{url('/owner/scholarship/create')}}" class="btn btn-primary btn-xs">New</a></h3>
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
                        <th>Scholarship ID</th>
                        <th>Featured Image</th>
                        <th>Title</th>
                        <th>School</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($scholarships as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>
                            @if($p->featured_image != null)
                            <img src="{{asset('uploads/scholarships/featured_image/small/'.$p->featured_image)}}" alt="Photo" width="70">
                            @else 
                            <img src="{{asset('uploads/scholarships/featured_image/default.png')}}" alt="Photo" width="70">
                            @endif
                        </td>
                        <td>{{$p->title}}</td>
                        <td>{{$p->sname}}</td>
                        <td>{{$p->cname}}</td>
                        <td>
                            <a href="{{url('/owner/scholarship/edit/'.$p->id)}}" class="btn btn-link text-success" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{url('/owner/scholarship/delete/'.$p->id)}}" class="btn btn-link text-danger" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$scholarships->links()}}
       </div>
   </div>
@endsection
