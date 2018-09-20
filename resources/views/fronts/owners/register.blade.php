@extends('layouts.front')
@section('content')
<!-- sign-up form -->
<div class="content">
    <div class="container">
            <form action="{{url('/owner/register')}}" method="POST" class="form-horizontal">
        <div class="row">
               
            <div class="col-sm-8">
                <h3 class="mb10">Power User - Create Your Account</h3>
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
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="name">First Name<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="first_name" name="first_name" type="text" class="form-control"
                            value="{{old('first_name')}}" placeholder="First Name"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="control-label col-sm-3">Last Name<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="last_name" class="form-control" name="last_name"
                            value="{{old('last_name')}}" required placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="control-label col-sm-3">Gender <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="gender" id="gender" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="type" class="control-label col-sm-3">Type <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="type" id="type" class="form-control">
                                <option value="Shop Owner">Shop Owner</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="address" class="control-label col-sm-3">Address</label>
                        <div class="col-sm-9">
                            <input type="text" id="address" class="form-control" name="address"
                            value="{{old('address')}}" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="control-label col-sm-3">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="text" id="email" class="form-control" name="email" 
                            value="{{old('email')}}" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="control-label col-sm-3">Phone <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="phone" class="form-control" name="phone" 
                                value="{{old('phone')}}" placeholder="Phone" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="username">Username <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="username" name="username" type="text" class="form-control" 
                                value="{{old('username')}}" placeholder="Enter your username"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="password">Password <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="password" name="password" type="password" class="form-control" placeholder="Create your password"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="cpassword">Re - Password <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="cpassword" name="cpassword" type="password" class="form-control" placeholder="Comfirm password"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">&nbsp;</label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary btn-block mb10">Register</button>
                            <p>You already have an account? <a href="{{url('/shop-owner/login')}}" class="text-danger">Click here to login!</a></p>
                        </div>
                    </div>
                    <div>
                       
                </div>
                
            </div>
            <div class="col-sm-4">
                <h3>Choose What You Want To Post!</h3>
                <hr>
                <div class="form-group row">
                    <input type="checkbox" value="1" name="post_product" id="post_product" checked>  &nbsp;
                    <label for="post_product">
                        Post Product
                    </label>
                </div>
                <div class="form-group row">
                    <input type="checkbox" value="1" name="post_company" id="post_company">  &nbsp;
                    <label for="post_company">
                        Post Company
                    </label>
                </div>
                <div class="form-group row">
                    <input type="checkbox" value="1" name="post_event" id="post_event">  &nbsp;
                    <label for="post_event">
                        Post Event
                    </label>
                </div>
                <div class="form-group row">
                    <input type="checkbox" value="1" name="post_school" id="post_school">  &nbsp;
                    <label for="post_school">
                        Post School
                    </label>
                </div>
                <div class="form-group row">
                    <input type="checkbox" value="1" name="post_review" id="post_review">  &nbsp;
                    <label for="post_review">
                        Post Review
                    </label>
                </div>
                <div class="form-group row">
                    <input type="checkbox" value="1" name="post_transfer" id="post_transfer">  &nbsp;
                    <label for="post_transfer">
                        Post Business Transfer
                    </label>
                </div>
            </div>
        </div>
            </form>
    </div>
</div>
@endsection