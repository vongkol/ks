@extends('layouts.front')
@section('content')
<div class="box-head top-head">
    <h3 class="head-title text-center"> Shop Detail</h3>
</div>

<div class="container">
    <div class="row" >
        <div class="col-md-3">
        <div id='cssmenu'>
                <ul>
                @foreach($shop_categories as $c)
                    <?php
                        $counter = DB::table('shops')
                            ->where('active',1)
                            ->where('shop_category', $c->id)
                            ->count();
                    ?>

                        <li> 
                            <a href="{{url('/shop-list/'.$c->id)}}">  
                                <i class="fa fa-shopping-cart"></i> {{$c->name}} <span class="text-info">{{$counter}}</span>
                            </a>
                        </li>
                    
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-9">
        <div class="row">
            <div class="col-md-12 pd-0">
                <div class="card shop-image">
                    <div class="img_feature">
                        <img src="{{asset('uploads/shops/shop_cover.jpg')}}" alt="" width="100%">
                        <div class="product">
                            <div class="shop-logo">
                                <img src="{{asset('uploads/shops/logo/'.$shop->logo)}}" alt="" width="150">
                            </div>
                            <h2 class="shop-name"> <span style="font-size: 15px;">{{$shop_owner->last_name}} {{$shop_owner->first_name}}</span> <br>{{$shop->name}} </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 pd-0">  
                <div class="card pd-10">
                    <h5>
                        <div class="row">
                            <div class="col-md-2">
                                Phone
                            </div>
                            <div class="col-md-5">
                                : {{$shop->phone}}
                            </div>
                        </div>
                    </h5>
                    <h5>
                        <div class="row">
                            <div class="col-md-2">
                                Email
                            </div>
                            <div class="col-md-5">
                                : {{$shop->email}}
                            </div>
                        </div>
                    </h5>
                    <h5>
                        <div class="row">
                            <div class="col-md-2">
                                Website 
                            </div>
                            <div class="col-md-5">
                                : {{$shop->website}}
                            </div>
                        </div>
                    </h5>
                    <h5>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>  
                                Shop Profile 
                                <hr>
                            </div>
                            <div class="col-md-12">
                                {!!$shop->description!!}
                            </div>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection