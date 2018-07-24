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
                <div class="col-md-2"><div class="categories " align="center" ><a href="{{url('/product-list')}}"><img src="images/car.png"><br>រថយន្តសម្រាប់លក់</a></div></div>
                <div class="col-md-2"><div class="categories " align="center" ><a href="{{url('/product-list')}}"><img src="images/phone.png"><br>រថយន្តសម្រាប់លក់</a></div></div>
                <div class="col-md-2"><div class="categories " align="center" ><a href="{{url('/product-list')}}"><img src="images/home.png"><br>រថយន្តសម្រាប់លក់</a></div></div>
                <div class="col-md-2"><div class="categories " align="center" ><a href="{{url('/product-list')}}"><img src="images/moto.png"><br>រថយន្តសម្រាប់លក់</a></div></div>
                <div class="col-md-2"><div class="categories " align="center" ><a href="{{url('/product-list')}}"><img src="images/computer.png"><br>រថយន្តសម្រាប់លក់</a></div></div>
                <div class="col-md-2"><div class="categories " align="center" ><a href="{{url('/product-list')}}"><img src="images/clothes.png"><br>រថយន្តសម្រាប់លក់</a></div></div>
                <div class="col-md-2"><div class="categories " align="center" ><a href="{{url('/product-list')}}"><img src="images/car.png"><br>រថយន្តសម្រាប់លក់</a></div></div>
                <div class="col-md-2"><div class="categories " align="center" ><a href="{{url('/product-list')}}"><img src="images/phone.png"><br>ទំរូស័ព្ទ</a></div></div>
                <div class="col-md-2"><div class="categories " align="center" ><a href="{{url('/product-list')}}"><img src="images/home.png"><br>ផ្ទះ</a></div></div>
                <div class="col-md-2"><div class="categories " align="center" ><a href="{{url('/product-list')}}"><img src="images/moto.png"><br>ម៉ូត៉ូ</a></div></div>
                <div class="col-md-2"><div class="categories " align="center" ><a href="{{url('/product-list')}}"><img src="images/computer.png"><br>កំុព្យទ័រ</a></div></div>
                <div class="col-md-2"><div class="categories " align="center" ><a href="{{url('/product-list')}}"><img src="images/clothes.png"><br>សំលៀកបំពាក់</a></div></div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="showcase-block">
                        <div class="display-logo">
                            <a href="#"> <img src="./images/nexus.png" alt=""></a>
                        </div>
                        <div class="showcase-img">
                            <a href="#"> <img src="./images/display_img_1.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="showcase-block active">
                        <div class="display-logo alignleft">
                            <a href="#">  <img src="./images/iphone.png" alt="">
                           </a>
                        </div>
                        <div class="showcase-img">
                            <a href="#"> <img src="./images/product_img_8.png" alt="" style="padding-left: 80px;"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="showcase-block ">
                        <div class="display-logo ">
                            <a href="#"> <img src="./images/samsung.png" alt="">
                            </a>
                        </div>
                        <div class="showcase-img">
                            <a href="#"><img src="./images/display_img_3.png" alt="">                    </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="showcase-block">
                        <div class="display-logo ">
                            <a href="#"><img src="./images/htc.png" alt=""></a>
                        </div>
                        <div class="showcase-img">
                            <a href="#"><img src="./images/display_img_4.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="showcase-block">
                        <div class="display-logo">
                            <a href="#">  <img src="./images/alcatel.png" alt=""></a>
                        </div>
                        <div class="showcase-img">
                            <a href="#"> <img src="./images/display_img_5.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="showcase-block">
                        <div class="display-logo ">
                            <a href="#"><img src="./images/pixel.png" alt=""></a>
                        </div>
                        <div class="showcase-img">
                            <a href="#">    <img src="./images/display_img_6.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="showcase-block">
                        <div class="display-logo ">
                            <a href="#">  <img src="./images/vivo.png" alt=""></a>
                        </div>
                        <div class="showcase-img">
                            <a href="#"><img src="./images/display_img_7.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.mobile showcase -->
    <!-- latest products -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Latest Product</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <!-- product -->
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pd-0">
                                <div class="product-block">
                                    <div class="product-img"><a href="{{url('product-single')}}"><img src="./images/product_img_1.png" alt=""></a></div>
                                    <div class="product-content">
                                        <h5><a href="#" class="product-title">Google Pixel <strong>(128GB, Black)</strong></a></h5>
                                        <div class="product-meta"><a href="#" class="product-price">$1100</a>
                                            <a href="#" class="discounted-price">$1400</a>
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
                                            <a href="#" class="discounted-price">$1700</a>
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
                            <!-- product -->
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pd-0">
                                <div class="product-block">
                                    <div class="product-img"><a href="{{url('product-single')}}"><img src="./images/product_img_3.png" alt=""></a></div>
                                    <div class="product-content">
                                        <h5><a href="#" class="product-title">Samsung Galaxy Note 8</a></h5>
                                        <div class="product-meta"><a href="#" class="product-price">$1500</a>
                                            <a href="#" class="discounted-price">$2000</a>
                                            <span class="offer-price">40%off</span>
                                        </div>
                                        <div class="shopping-btn">
                                            <a href="" class="product-btn btn-like"><i class="fa fa-heart"></i></a>
                                            <a href="#" class="product-btn btn-cart"><i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.product -->
                            <!-- product -->
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pd-0">
                                <div class="product-block">
                                    <div class="product-img"><a href="{{url('product-single')}}"><<img src="./images/product_img_4.png" alt=""></a></div>
                                    <div class="product-content">
                                        <h5><a href="#" class="product-title">Vivo V5 Plus <strong>(Matte Black)</strong></a></h5>
                                        <div class="product-meta"><a href="#" class="product-price">$1500</a>
                                            <a href="#" class="discounted-price">$2000</a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.latest products -->
    <!-- seller products -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Flash Sale</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-carousel">
            <div class="box-body">
                <div class="row">
                    <div class="owl-carousel owl-two owl-theme">
                        <!-- product -->
                        <div class="item">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd-0">
                                <div class="product-block">
                                    <div class="product-img"><a href="{{url('product-single')}}"><img src="./images/product_img_5.png" alt=""></a></div>
                                    <div class="product-content">
                                        <h5><a href="#" class="product-title">Apple iPhone 6 <strong>(32 GB, Gold)</strong></a></h5>
                                        <div class="product-meta"><a href="#" class="product-price">$1700</a>
                                            <a href="#" class="discounted-price">$2000</a>
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
                        </div>
                        <!-- product -->
                        <div class="item">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd-0">
                                <div class="product-block">
                                    <div class="product-img"><a href="{{url('product-single')}}"><img src="./images/product_img_6.png" alt=""></a></div>
                                    <div class="product-content">
                                        <h5><a href="#" class="product-title">Apple iPhone 7 <strong>(256 GB, Black)</strong> </a></h5>
                                        <div class="product-meta"><a href="#" class="product-price">$1400</a>
                                            <a href="#" class="discounted-price"><strike>$1800</strike></a>
                                            <span class="offer-price">20%off</span>
                                        </div>
                                        <div class="shopping-btn">
                                            <a href="#" class="product-btn btn-like"><i class="fa fa-heart"></i></a>
                                            <a href="#" class="product-btn btn-cart"><i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.product -->
                        <!-- product -->
                        <div class="item">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd-0">
                                <div class="product-block">
                                    <div class="product-img"><a href="{{url('product-single')}}"><img src="./images/product_img_7.png" alt=""></a></div>
                                    <div class="product-content">
                                        <h5><a href="#" class="product-title">Apple iPhone 6S <strong>(32GB, Gold)</strong> </a></h5>
                                        <div class="product-meta"><a href="#" class="product-price">$1300</a>
                                            <a href="#" class="discounted-price"><strike>$2000</strike></a>
                                            <span class="offer-price">20%off</span>
                                        </div>
                                        <div class="shopping-btn">
                                            <a href="#" class="product-btn btn-like"><i class="fa fa-heart"></i></a>
                                            <a href="#" class="product-btn btn-cart"><i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.product -->
                        <!-- product -->
                        <div class="item">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd-0">
                                <div class="product-block">
                                    <div class="product-img"><a href="{{url('product-single')}}"><img src="./images/product_img_8.png" alt=""></a></div>
                                    <div class="product-content">
                                        <h5><a href="#" class="product-title">Apple iPhone X <strong>(64 GB, Grey)</strong></a></h5>
                                        <div class="product-meta"><a href="#" class="product-price">$1200</a>
                                            <a href="#" class="discounted-price"><strike>$2000</strike></a>
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
                        </div>
                    </div>
                </div>
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
                                <div class="product-block">
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
                                <div class="product-block">
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