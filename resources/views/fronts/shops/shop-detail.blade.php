@extends('layouts.front')
@section('meta')
<meta name="description" content="{{$shop->name}} - {{$shop->address}}">
@endsection
@section('content')
<div class="box-head top-head">
    <h3 class="head-title text-center"> {{$shop->name}}</h3>
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
                            @if($shop_owner!=null)
                            <h2 class="shop-name"> <span style="font-size: 15px;">{{$shop_owner->last_name}} {{$shop_owner->first_name}}</span> <br>{{$shop->name}} </h2>
                            @endif
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
                        <div class="row">
                                <div class="col-sm-12">
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                        <div class="fb-share-button" data-href="{{url('/shop/detail/'.$shop->id)}}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url('/shop/detail/'.$shop->id)}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection