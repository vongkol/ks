@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">

           @if($shop==null)
            <h3 class="text-center text-danger">You don't have a shop yet. Please create a new one!</h3>
            <div class="text-center"><a href="{{url('/owner/shop/create')}}" class="btn btn-success btn-xs">Create New Shop</a></div>
            @else
            <div class="text-center">
                <img src="{{asset('uploads/shops/logo/'.$shop->logo)}}" alt="Photo" width="130">
                <p></p>
                <h3 class="text-primary">{{$shop->name}}</h3>
                </div>
                <hr>
                <div class="row">
                        <div class="col-sm-6">
                            <form action="#" class="form-horizontal">
                                <div class="form-group row">
                                    <label for="" class="control-label col-sm-3">Shop Name</label>
                                    <div class="col-sm-9">
                                        : {{$shop->name}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="control-label col-sm-3">Category</label>
                                    <div class="col-sm-9">
                                        : {{$shop->cname}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="control-label col-sm-3">Email</label>
                                    <div class="col-sm-9">
                                        : {{$shop->email}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="control-label col-sm-3">Phone</label>
                                    <div class="col-sm-9">
                                        : {{$shop->phone}}
                                    </div>
                                </div>
                              
                                <div class="form-group row">
                                    <label for="" class="control-label col-sm-3">Address</label>
                                    <div class="col-sm-9">
                                        : {{$shop->address}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="control-label col-sm-3">website</label>
                                    <div class="col-sm-9">
                                        : {{$shop->website}}
                                        <p></p>
                                        <p><a href="{{url('/owner/shop/edit?id='.$shop->id)}}" class="btn btn-primary btn-xs">Edit Shop</a></p>
                                    </div>
                                </div>
                               
                            </form>
                        </div>
                        <div class="col-sm-6">
                           <h4>Description</h4>
                           {!!$shop->description!!}
                        </div>
                    </div>
           @endif
            
           
       </div>
   </div>
@endsection