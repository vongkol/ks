@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">
            <p></p>
            <h3 class="text-primary">My Profile</h3>
            <hr>
            <div class="row">
                <div class="col-sm-7">
                    <form action="#" class="form-horizontal">
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">First Name</label>
                            <div class="col-sm-9">
                                : {{$user->first_name}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Last Name</label>
                            <div class="col-sm-9">
                                : {{$user->last_name}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Gender</label>
                            <div class="col-sm-9">
                                : {{$user->gender}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Email</label>
                            <div class="col-sm-9">
                                : {{$user->email}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Phone</label>
                            <div class="col-sm-9">
                                : {{$user->phone}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Address</label>
                            <div class="col-sm-9">
                                : {{$user->address}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Username</label>
                            <div class="col-sm-9">
                                : {{$user->username}}
                            </div>
                        </div>
                       
                    </form>
                </div>
                <div class="col-sm-5">
                    <img src="{{asset('uploads/shop_owners/profile/'.$user->photo)}}" alt="Photo" width="130">
                    <p></p>
                    <p>
                        <a href="{{url('/owner/profile/edit')}}" class="btn btn-primary btn-xs">Edit Profile</a>
                    </p>
                </div>
            </div>
       </div>
   </div>
@endsection