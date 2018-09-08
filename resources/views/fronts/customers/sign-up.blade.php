@extends('layouts.front')
@section('content')
<!-- sign-up form -->
<div class="content">
    <div class="container">
        <form action="{{url('/customer/save')}}" method="POST">
            <div class="row">
                {{csrf_field()}}
                <div class="col-sm-8">
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
                    <div class="form-group row">
                        <label for="" class="col-sm-3">First Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="first_name" 
                            required autofocus value="{{old('first_name')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Last Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="last_name" required value="{{old('last_name')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Gender <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="gender" id="gender" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" value="{{old('email')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Username <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" required value="{{old('username')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Password <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" required >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Confirm Password <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="cpassword" required >
                        </div>
                    </div>
                    <div class="form-grou row">
                        <label for="" class="col-sm-3">&nbsp;</label>
                        <div class="col-sm-9">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
@endsection