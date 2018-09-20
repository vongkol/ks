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
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3"><strong><u>What I will Post </u></strong></label>
                            <div class="col-sm-9">
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="checkbox" value="1" name="post_product" id="post_product" {{$user->post_product?'checked':''}} disabled>  &nbsp;
                            <label for="post_product">
                                Post Product
                            </label>
                        </div>
                        <div class="form-group row">
                            <input type="checkbox" value="1" name="post_company" id="post_company" {{$user->post_company?'checked':''}} disabled>  &nbsp;
                            <label for="post_company">
                                Post Company
                            </label>
                        </div>
                        <div class="form-group row">
                            <input type="checkbox" value="1" name="post_event" id="post_event" {{$user->post_event?'checked':''}} disabled>  &nbsp;
                            <label for="post_event">
                                Post Event
                            </label>
                        </div>
                        <div class="form-group row">
                            <input type="checkbox" value="1" name="post_school" id="post_school" {{$user->post_school?'checked':''}} disabled>  &nbsp;
                            <label for="post_school">
                                Post School
                            </label>
                        </div>
                        <div class="form-group row">
                            <input type="checkbox" value="1" name="post_review" id="post_review" {{$user->post_review?'checked':''}} disabled>  &nbsp;
                            <label for="post_review">
                                Post Review
                            </label>
                        </div>
                        <div class="form-group row">
                            <input type="checkbox" value="1" name="post_transfer" id="post_transfer" {{$user->post_transfer?'checked':''}} disabled>  &nbsp;
                            <label for="post_transfer">
                                Post Business Transfer
                            </label>
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