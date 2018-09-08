@extends('layouts.front')
@section('content')
<div class="content">
        <div class="container">
            <div class="box">
                <div class="row">
                    <div class="col-lg-5 col-md-5"> 
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
                        <h3 class="mb10">Login</h3>
                        <!-- form -->
                        <form action="{{url('/customer/do-login')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="control-label sr-only" for="username"></label>
                                <div class="login-input">
                                    <input id="username" name="username" type="text" class="form-control" placeholder="Username"  required>
                                    <div class="login-icon"><i class="fa fa-user"></i></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label sr-only"></label>
                                <div class="login-input">
                                    <input name="password" type="password" class="form-control" placeholder="******"  required>
                                    <div class="login-icon"><i class="fa fa-lock"></i></div>
                                </div>
                            </div>
                            <button class="btn btn-info btn-block mb10" type="submit">Sign In</button>
                            <div>
                                <p>Don't have an account yet? <a href="{{url('/customer/sign-up')}}">Sign up here!</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!-- /.login-form -->
@endsection