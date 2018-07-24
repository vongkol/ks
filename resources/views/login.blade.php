@extends('layouts.front')
@section('content')
<div class="content">
        <div class="container">
            <div class="box">
                <div class="row">
                    <div class="col-lg-5 col-md-5"> 
                        <h3 class="mb10">Login</h3>
                        <!-- form -->
                        <form>
                            <div class="form-group">
                                <label class="control-label sr-only" for="email"></label>
                                <div class="login-input">
                                    <input id="email" name="emaol" type="text" class="form-control" placeholder="Enter your email id"  required>
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
                        
                
                            <button class="btn btn-info btn-block mb10">Sign In</button>
                            <div>
                                <p>Have an Acount? <a href="#">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!-- /.login-form -->
       @endsection