@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">
            <p></p>
            <h3 class="text-primary">My Company <a href="{{url('/owner/company/create')}}" class="btn btn-primary btn-xs">New</a></h3>
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
                        <th>Company ID</th>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Office Phone</th>
                        <th>Office Email</th>
                        <th>Website</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>
                            @if($p->logo != null)
                            <img src="{{asset('uploads/companies/logo/'.$p->logo)}}" alt="Photo" width="70">
                            @else 
                            <img src="{{asset('uploads/companies/logo/default.png')}}" alt="Photo" width="70">
                            @endif
                        </td>
                        <td>{{$p->name}}</td>
                        <td>{{$p->address}}</td>
                        <td>{{$p->office_phone}}</td>
                        <td>{{$p->office_email}}</td>
                        <td>{{$p->website}}</td>
                        <td>
                            <a href="{{url('/owner/company/edit/'.$p->id)}}" class="btn btn-link text-success" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{url('/owner/company/delete/'.$p->id)}}" class="btn btn-link text-danger" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$companies->links()}}
       </div>
   </div>
@endsection
