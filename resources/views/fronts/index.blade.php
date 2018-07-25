@extends('layouts.front')
@section('content')
<!-- slider -->
<?php $slides = DB::table('slides')->where('active', 1)->orderBy('order', 'asc')->get(); ?>
    <div class="slider">
        <div class="owl-carousel owl-one owl-theme">
            @foreach($slides as $slide)
            <div class="item">
                <div class="slider-img">
                    <a href="{{$slide->url}}"><img src="{{asset('uploads/slides/image/'.$slide->photo)}}" alt=""></a>
                
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-8 col-sm-6 col-xs-12">
                            <div class="slider-captions">
                                <h1 class="slider-title"><a href="{{$slide->url}}">{{$slide->name}}</a></h1>
                                <p class="hidden-xs">{{$slide->short_description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           @endforeach
        </div>
    </div>

    <!-- /.slider -->
    <!-- mobile showcase -->
    <div class="space-medium">
        <div class="container">
            <div class="row">
                @foreach($categories as $c)
                    <div class="col-md-2">
                        <div class="categories " align="center" >
                        <a href="{{url('/product/category/'.$c->id)}}"><img src="{{asset('uploads/product-categories/'.$c->icon)}}" alt="" width="64"><br>{{$c->name}}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /.mobile showcase -->
    <!-- latest products -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Latest Products</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            @foreach($products as $p)
                                <div class="col-lg-3 col-md-3 col-sm-6 pd-0">
                                    <div class="product-block  h-100">
                                        <div class="product-img"><a href="{{url('product/'.$p->id)}}"><img src="{{asset('uploads/products/featured/'.$p->featured_image)}}" alt="" width="100%"></a></div>
                                        <div class="product-content">
                                            <h5><a href="{{url('product/'.$p->id)}}" class="product-title">{{$p->name}}</h5>
                                            <div class="product-meta"><a href="#" class="product-price">${{$p->price}}</a>
                                                <a href="{{url('product/'.$p->id)}}" class="discounted-price">${{$p->sell_price}}</a>
                                            </div>
                                            <div class="shopping-btn">
                                                {{-- <a href="#" class="product-btn btn-like"><i class="fa fa-heart"></i></a>
                                                <a href="#" class="product-btn btn-cart"><i class="fa fa-shopping-cart"></i></a> --}}
                                                <a href="{{url('product/'.$p->id)}}" class="btn btn-primary btn-xs">View Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box">
                        <div class="box-head">
                            <h3 class="head-title">Latest Baby Products</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                @foreach($baby as $p)
                                    <div class="col-lg-3 col-md-3 col-sm-6 pd-0">
                                        <div class="product-block h-100">
                                            <div class="product-img"><a href="{{url('product/'.$p->id)}}"><img src="{{asset('uploads/products/featured/'.$p->featured_image)}}" alt="" width="100%"></a></div>
                                            <div class="product-content">
                                                <h5><a href="{{url('product/'.$p->id)}}" class="product-title">{{$p->name}}</h5>
                                                <div class="product-meta"><a href="#" class="product-price">${{$p->sell_price}}</a>
                                                    <a href="#" class="discounted-price">${{$p->price}}</a>
                                                </div>
                                                <div class="shopping-btn">
                                                   <a href="{{url('product/'.$p->id)}}" class="btn btn-success btn-xs">View Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="container">
        <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="box">
                            <div class="box-head">
                                <h3 class="head-title">Latest Events</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    @foreach($events as $ev)
                                        <div class="col-lg-3 col-md-3 mb20 pd-0">
                                            <div class="product-block h-100">
                                                <div class="image-event">
                                                    <a href="{{url('/event/detail/'.$ev->id)}}" target="_blank">
                                                        <img src="{{asset('/uploads/events/featured_image/small/'.$ev->featured_image)}}" width="100%" alt="">
                                                    </a>
                                                </div>
                                                <div align="left" class="product-content">
                                                    <h5  class="text-gray index-text">
                                                        <i class="fa fa-calendar-check-o"></i> {{$ev->event_date}} <b>-</b> <i class="fa fa-clock-o" ></i> {{$ev->start_time }} <label class="price float-right">
                                                            @if($ev->price <= 0)
                                                                Free
                                                            @else 
                                                                $ {{$ev->price}}
                                                            @endif
                                                        </label>
                                                    </h5>
                                                    <h4 class="index-event-title"> <a href="{{url('/event/detail/'.$ev->id)}}" target="_blank">{{$ev->title}}</a></h4>
                                                    <h5  class="text-gray index-event-location">
                                                        <i class="fa fa-map-marker"></i> {{$ev->location}}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Latest Scholarship</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            @foreach($scholarships as $sch)
                                <div class="col-lg-3 col-md-3 pd-0" style="margin-bottom: 18px;">
                                    <div class="product-block h-100">
                                        <div class="product-img"><a href="{{url('/event/detail/'.$sch->id)}}"><img src="{{asset('uploads/scholarships/featured_image/'.$sch->featured_image)}}" alt="" width="100%"></a></div>
                                        <div class="product-content">
                                            <h5><a href="#" class="product-title">{{$sch->title}}</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- seller products -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Top Schools</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                @foreach($schools as $sc)
                    <div class="col-lg-3 col-md-3 mb20 pd-0">
                        <div class="product-block h-100">
                                <div class="image-event">
                                    <a href="{{url('/school/detail/'.$sc->id)}}" target="_blank">
                                        <img src="{{asset('uploads/schools/logo/'.$sc->logo)}}" width="150" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                <h5><a href="{{url('/school/detail/'.$sc->id)}}" class="product-title">{{$sc->name_english}}</a></h5>
                                <div class="product-meta">
                                    {{$sc->name_khmer}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /.seller products -->
    <!-- featured products -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Listing</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <!-- product -->
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pd-0">
                                <div class="product-block h-100">
                                    <div class="product-img"><a href="{{url('product-single')}}"><<img src="./images/product_img_3.png" alt=""></a></div>
                                    <div class="product-content">
                                        <h5><a href="#" class="product-title">Samsung Galaxy Note 8</a></h5>
                                        <div class="product-meta"><a href="#" class="product-price">$1500</a>
                                            <a href="#" class="discounted-price"><strike>$2000</strike></a>
                                            <span class="offer-price">40%off</span>
                                        </div>
                                        <div class="shopping-btn">
                                            <a href="#" class="product-btn btn-like"><i class="fa fa-heart"></i></a>
                                            <a href="#" class="product-btn btn-cart"><i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.product -->
                            <!-- product -->
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pd-0">
                                <div class="product-block h-100">
                                    <div class="product-img"><a href="{{url('product-single')}}"><<img src="./images/product_img_4.png" alt=""></a></div>
                                    <div class="product-content">
                                        <h5><a href="#" class="product-title">Vivo V5 Plus <strong>(Matte Black)</strong></a></h5>
                                        <div class="product-meta"><a href="#" class="product-price">$1500</a>
                                            <a href="#" class="discounted-price"><strike>$2000</strike></a>
                                            <span class="offer-price">15%off</span>
                                        </div>
                                        <div class="shopping-btn">
                                            <a href="#" class="product-btn btn-like">
                                                <i class="fa fa-heart"></i></a>
                                            <a href="#" class="product-btn btn-cart"><i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.product -->
                            <!-- product -->
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pd-0">
                                <div class="product-block">
                                    <div class="product-img"><a href="{{url('product-single')}}"><<img src="./images/product_img_1.png" alt=""></a></div>
                                    <div class="product-content">
                                        <h5><a href="#" class="product-title">Google Pixel <strong>(128GB, Black)</strong></a></h5>
                                        <div class="product-meta"><a href="#" class="product-price">$1100</a>
                                            <a href="#" class="discounted-price"><strike>$1400</strike></a>
                                            <span class="offer-price">20%off</span>
                                        </div>
                                        <div class="shopping-btn">
                                            <a href="#" class="product-btn btn-like"><i class="fa fa-heart"></i></a>
                                            <a href="#" class="product-btn btn-cart"><i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.product -->
                            <!-- product -->
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pd-0">
                                <div class="product-block">
                                    <div class="product-img"><a href="{{url('product-single')}}"><<img src="./images/product_img_2.png" alt=""></a></div>
                                    <div class="product-content">
                                        <h5><a href="#" class="product-title">HTC U Ultra <strong>(64GB, Blue)</strong></a></h5>
                                        <div class="product-meta"><a href="#" class="product-price">$1200</a>
                                            <a href="#" class="discounted-price"><strike>$1700</strike></a>
                                            <span class="offer-price">10%off</span>
                                        </div>
                                        <div class="shopping-btn">
                                            <a href="#" class="product-btn btn-like"><i class="fa fa-heart"></i></a>
                                            <a href="#" class="product-btn btn-cart"><i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.product -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-default pdt40 pdb40">
        <div class="container">
            <div class="row">
                <!-- features -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-left">
                        <div class="feature-outline-icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="text-white">Safe Payment</h3>
                            <p>Praesent orci dolor, pretium vitae hendrerit convallisutes orcgravida bibendum.</p>
                        </div>
                    </div>
                </div>
                <!-- features -->
                <!-- features -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-left">
                        <div class="feature-outline-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="text-white">24/7 Help Center</h3>
                            <p>Aliquam molestie urnased one pharetra vestibulum Interdum et malesuada fames.</p>
                        </div>
                    </div>
                </div>
                <!-- features -->
                <!-- features -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-left feature-circle">
                        <div class="feature-outline-icon">
                            <i class="fa fa-rotate-left "></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="text-white">Free &amp; Easy Return</h3>
                            <p>Vivamus semper nisnesbla accumsan dui justo esw finibus turpis serom.</p>
                        </div>
                    </div>
                </div>
                <!-- features -->
                <!-- features -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-left">
                        <div class="feature-outline-icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="text-white">Great Value</h3>
                            <p>Morbi necmi turpiulm tristiq ueipsm inodiopharetr amal esuat erdumetalesuada.</p>
                        </div>
                    </div>
                </div>
                <!-- features -->
            </div>
        </div>
    </div>
    <!-- /.features -->
    @endsection