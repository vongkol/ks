@extends('layouts.front')
@section('content')
<!-- product-single -->
<div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box">
                        <!-- product-description -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                    <ul id="demo1_thumbs" class="slideshow_thumbs">
                                        <li>
                                            <a href="./images/thumb_big_1.jpg">
                                                <div class=" thumb-img"><img src="./images/thumb_1.jpg" alt=""></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./images/thumb_big_2.jpg">
                                                <div class=" thumb-img"><img src="./images/thumb_2.jpg" alt=""></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./images/thumb_big_3.jpg" alt="">
                                                <div class=" thumb-img"><img src="./images/thumb_3.jpg" alt=""></div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div id="slideshow"></div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="product-single">
                                        <h2>Google Pixel </h2>
                                        <p class="product-price" style="font-size: 38px;">$1100 <strike>$1300</strike></p>
                                        <p>12.2 MP Rear | 8 MP Front Camera, 4GB RAM, 2700 mAh battery, Android 8.0, Qualcomm Snapdragon 835, Fingerprint Sensor</p>
                                        <div class="product-quantity">
                                            <h5>Quantity</h5>
                                            <div class="quantity mb20">
                                                <input type="number" class="input-text qty text" step="1" min="1" max="6" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*">
                                            </div>
                                        </div>
                                        <a href="{{url('/cart')}}">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-shopping-cart"></i>&nbsp;Add to cart</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box-head scroll-nav">
                        <div class="head-title"> <a class="page-scroll active" href="#product">Product Details</a>
                    </div>
                </div>
            </div>
            <!-- highlights -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box" id="product">
                        <div class="box-body">
                            <div class="highlights">
                                <h4 class="product-small-title">Highlights</h4>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul class="arrow">
                                            <li>12.2 MP Rear | 8 MP Front Camera </li>
                                            <li>4GB RAM </li>
                                            <li>2700 mAh battery</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul class="arrow">
                                            <li>Android 8.0 </li>
                                            <li>Qualcomm Snapdragon 835</li>
                                            <li>Fingerprint Sensor</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="highlights">
                                <h4 class="product-small-title">Specification</h4>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h4>General</h4>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb30">
                                        <ul>
                                            <li>Brand</li>
                                            <li>Model Number </li>
                                            <li>Body Material</li>
                                            <li>Sim Size</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb30">
                                        <ul>
                                            <li style="color: #1c1e1e;">Google Pixel </li>
                                            <li style="color: #1c1e1e;">Google XYZ</li>
                                            <li style="color: #1c1e1e;">Metal and Polycarbonate</li>
                                            <li style="color: #1c1e1e;">Micro</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h4>Display</h4>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li>Screen Size </li>
                                            <li>Display Resolution </li>
                                            <li>Pixel Density</li>
                                            <li>Screen Protection </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li style="color: #1c1e1e;">5 inch </li>
                                            <li style="color: #1c1e1e;">1280 X 720 Pixels</li>
                                            <li style="color: #1c1e1e;">294 PPI</li>
                                            <li style="color: #1c1e1e;">Gorilla Glass 4</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- /.product-description -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box-head">
                    <h3 class="head-title">Related Product</h3>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <!-- product -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pd-0">
                        <div class="product-block">
                            <div class="product-img"><img src="./images/product_img_1.png" alt=""></div>
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
                            <div class="product-img"><img src="./images/product_img_2.png" alt=""></div>
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
                            <div class="product-img"><img src="./images/product_img_3.png" alt=""></div>
                            <div class="product-content">
                                <h5><a href="#" class="product-title">Samsung Galaxy Note 8</a></h5>
                                <div class="product-meta"><a href="#" class="product-price">$1500</a>
                                    <a href="#" class="discounted-price">$2000</a>
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
                            <div class="product-img"><img src="./images/product_img_4.png" alt=""></div>
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
    <!-- /.product-single -->
    </div>
@endsection