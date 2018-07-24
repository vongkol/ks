@extends('layouts.front')
@section('content')
<div class="box-head top-head">
    <h3 class="head-title text-center">Shop List</h3>
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
            @foreach($shops as $shop)
            <div class="col-lg-4 col-md-4 col-sm-4 mb20 pd-0">
                <div class="product-block h-100">
                    <div class="product-img">
                        <a href="{{url('/shop/detail/'.$shop->id)}}"><img src="{{asset('/uploads/shops/logo/'.$shop->logo)}}" width="150" alt=""></a>
                    </div>
                    <div align="left" class="product-content">
                        
                        <h5  class="text-center">
                        <a href="{{url('/shop/detail/'.$shop->id)}}"><b class="text-info">{{$shop->name}}</b></a>
                        </h5>
                    </div>
                </div>
            </div>
            @endforeach  
            </div>
            <div class="row">
                <div class="col-md-12">
                {{$shops->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection