@extends('layouts.front')
@section('content')
 <!-- product-list -->
 <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <!-- sidenav-section -->
                    <div id='cssmenu'>
                        <ul>
                            <li class='has-sub'><a href='#'>CATEGORY</a>
                                <ul>
                                    <li><a href='#'>Smart Phones</a></li>
                                    <li><a href='#'>Cell Phones</a></li>
                                    <li class='last'><a href='#'>Android Phones</a></li>
                                </ul>
                            </li>
                            <li class='has-sub'><a href='#'>Brand (07)</a>
                                <ul>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">Alcatel
                                </label>
                        
                                 </span>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">Apple</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">Google</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">HTC</span>
                                        </label>
                                        </span>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">Samsung</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">Vivo</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">Nexus</span>
                                        </label>
                                    </li>
                                </ul>
                            </li>
                            <li class='has-sub'><a href='#'>Price</a>
                                <ul>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">500-1000</span>
                                        </label>
                                    </li>
                                    <li><span>
                                    <label>
                                        <input type="checkbox">
                                        <span class="checkbox-list">1000-2000</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">2000-5000</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">5000-10000</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">10000-1800</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">18000-25000</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">Above-25000</span>
                                        </label>
                                    </li>
                                </ul>
                            </li>
                            <li class='has-sub'><a href='#'>Screen Size</a>
                                <ul>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">3 - 3.9 inches</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">4 - 4.9 inches</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">5 - 5.9 inches</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">6 inch &amp; above</span>
                                        </label>
                                    </li>
                                </ul>
                            </li>
                            <li class='has-sub'><a href='#'>PROCESSOR CORES</a>
                                <ul>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">Hexa Core</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">Octa Core</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">Quad Core</span>
                                        </label>
                                    </li>
                                </ul>
                            </li>
                            <li class='has-sub'><a href='#'>FEATURES</a>
                                <ul>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">3G Support</span></label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">4G Support</span></label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">Duel Camera</span></label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">Expandable Memory</span></label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-list">FM Radio</span></label>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidenav-section -->
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                    <div class="row">
                        <!-- product -->
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb30">
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
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb30">
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
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb30">
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
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb30">
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
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb30">
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
                        <!-- product -->
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb30">
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
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb30">
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
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb30">
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
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb30">
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
                    </div>
                    <div class="row">
                        <!-- pagination start -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="st-pagination">
                                <ul class="pagination">
                                    <li><a href="#" aria-label="previous"><span aria-hidden="true">Previous</span></a> </li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li> <a href="#" aria-label="Next"><span aria-hidden="true">Next</span></a> </li>
                                </ul>
                            </div>
                        </div>
                        <!-- pagination close -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection