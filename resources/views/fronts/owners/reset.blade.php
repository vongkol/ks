@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">
            <p></p>
            <h3 class="text-primary">Reset My Password</h3>
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
            <form action="{{url('/owner/reset-password/update')}}" class="form-horizontal" method="POST">
            <div class="row">
                <div class="col-sm-7">
                   
                        {{csrf_field()}}
                        <input type="hidden" value="{{$user->id}}" name="id">
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-4">New Password <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="password" name="pass" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-4">Confirm Password <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="password" required name="cpass" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-4">&nbsp;</label>
                            <div class="col-sm-8">
                                <button class="btn btn-primary btn-xs" type="submit">Reset Password</button>
                            </div>
                        </div>
                        
                       
                </div>
                <div class="col-sm-5">
                   
                </div>
            </div>
            </form>
       </div>
   </div>
   
@endsection