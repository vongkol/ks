@extends('layouts.front')
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-1 col-md-1">
                                    <div class="productlist">
                                        <ul id="demo1_thumbs" class="slideshow_thumbs">
                                                <li>
                                                    <a onclick="product(event)" href="#" src="{{asset('uploads/products/featured/500/'.$product->featured_image)}}">
                                                        <div class="thumb-img"><img src="{{asset('uploads/products/featured/500/'.$product->featured_image)}}" alt=""></div>
                                                    </a>
                                                </li>
                                            @foreach($photos as $photo)
                                                <li>
                                                    <a onclick="product(event)" href="#" src="{{asset('uploads/products/'.$photo->photo)}}">
                                                        <div class="thumb-img"><img src="{{asset('uploads/products/'.$photo->photo)}}" alt=""></div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5">
                                    <!-- <div id="slide"> -->
                                        <img id="slide" src="{{asset('uploads/products/featured/500/'.$product->featured_image)}}" alt="" width="100%" style="border:1px solid #ccc" id="preview">
                                    <!-- </div> -->
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="product-single">
                                        <h2>{{$product->name}}</h2>
                                    
                                        <p class="product-price" style="font-size: 38px;">$ {{$product->sell_price}} <strike>$ {{$product->price}}</strike></p>
                                        <p>{{$product->short_description}}</p>
                                        <div class="product-quantity">
                                            <h5>Quantity</h5>
                                            <div class="quantity mb20">
                                                <input type="number" class="input-text qty text" step="1" min="1" max="6" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-default"><i class="fa fa-shopping-cart"></i>&nbsp;Add to cart</button>
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
                        <div class="head-title"> <a class="page-scroll" href="#product">Product Details</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $product->description!!}
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function product(e) {
            
            }
        </script>
@endsection