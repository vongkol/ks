@extends('layouts.front')
@section('content')
<div class="content">
        <div class="container">
            <div class="box">
                <div class="row">
                    <div class="col-sm-7"> 
                        <h3 class="mb10">Shop Owner Login</h3>
                        <hr>
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
                        <form action="{{url('/owner/do-login')}}" method="POST" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3" for="username">Username <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input id="username" name="username" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3">Password <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="password" type="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="control-label col-sm-3">&nbsp;</label>
                                <div class="col-sm-9">
                                    <button class="btn btn-info btn-block mb10" type="submit">Sign In</button>
                                    <div>
                                        <p>You have don't have an account yet? <a href="{{url('/shop-owner/register')}}" class="text-danger">Click here to sign up!</a></p>
                                    </div>
                                </div>
                            </div>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!-- /.login-form -->
       @endsection