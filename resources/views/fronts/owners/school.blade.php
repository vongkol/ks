@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">
            <p></p>
            <h3 class="text-primary">My School <a href="{{url('/owner/school/create')}}" class="btn btn-primary btn-xs">New</a></h3>
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
                        <th>Logo</th>
                        <th>Khmer Name</th>
                        <th>English Name</th>
                        <th>Category</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schools as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>
                            <img src="{{asset('uploads/schools/logo/'.$p->logo)}}" alt="Photo" width="70">
                        </td>
                        <td>{{$p->name_khmer}}</td>
                        <td>{{$p->name_english}}</td>
                        <td>{{$p->cname}}</td>
                        <td>{{$p->phone}}</td>
                        <td>{{$p->email}}</td>
                        <td>
                            <a href="{{url('/owner/school/edit/'.$p->id)}}" class="btn btn-link text-success" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{url('/owner/school/delete/'.$p->id)}}" class="btn btn-link text-danger" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$schools->links()}}
       </div>
   </div>
@endsection
