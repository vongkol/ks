@extends('layouts.front')
@section('content')
<!-- cart-section -->
 <div class="space-medium">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="box">
                        <div class="box-head">
                            <h3 class="head-title">My Cart (02)</h3>
                        </div>
                        <!-- cart-table-section -->
                        <div class="box-body2">
                            <div class="table-responsive">
                                <div class="cart">
                                    <table class="table table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <span>Item</span></th>
                                                <th>
                                                    <span>Price</span></th>
                                                <th>
                                                    <span>Quantity</span></th>
                                                <th>
                                                    <span>Total</span></th>
                                                <th>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="#"><img src="./images/cart_product_1.png" alt=""></a>
                                                    <span><a href="#">Google Pixle</a></span>
                                                </td>
                                                <td>$1100</td>
                                                <td>
                                                    <div class="product-quantity">
                                                        <div class="quantity">
                                                            <input type="number" class="input-text qty text" step="1" min="1" max="6" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>$1100.00</td>
                                                <th scope="row"><a href="#" class="btn-close"><i class="fa fa-times-circle-o"></i></a></th>
                                            </tr>
                                            <tr>
                                                <td><a href="#"><img src="./images/cart_product_2.png" alt=""></a>
                                                    <span><a href="#">Apple iPhone 6S </a></span>
                                                </td>
                                                <td>$1300</td>
                                                <td>
                                                    <div class="product-quantity">
                                                        <div class="quantity">
                                                            <input type="number" class="input-text qty text " step="1" min="1" max="6" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>$1300.00</td>
                                                <th scope="row"><a href="#" class="btn-close"><i class="fa fa-times-circle-o"></i></a></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.cart-table-section -->
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn-link"><i class="fa fa-angle-left"></i> back to shopping</a>
                </div>
                <!-- cart-total -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="box mb30">
                        <div class="box-head">
                            <h3 class="head-title">Price Details</h3>
                        </div>
                        <div class="box-body2">
                            <div class=" table-responsive">
                                <div class="pay-amount ">
                                    <table class="table mb20">
                                        <tbody>
                                            <tr>
                                                <th>
                                                    <span>Price (2 items)</span></th>
                                                <td>$2400</td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <span>Delivery Charges</span></th>
                                                <td><strong class="text-green">Free</strong></td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <th>
                                                    <span class="mb0" style="font-weight: 700;">Amount Payable</span></th>
                                                <td style="font-weight: 700; color: #1c1e1e; ">$2400</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="{{url('checkout')}}">
                                    <button class="btn btn-primary btn-block">Proceed To Checkout</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- coupon-section -->
                    <div class="box mb30">
                        <div class="box-head">
                            <h3 class="head-title">Coupons &amp; Offers</h3>
                        </div>
                        <div class="box-body2">
                            <form>
                                <div class="coupon-form">
                                    <input type="text" name="coupon_code" class="form-control" id="coupon_code" value="" placeholder="Coupon code">
                                    <input type="submit" class="btn btn-primary btn-block" name="apply_coupon" value="Apply coupon">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.coupon-section -->
                </div>
            </div>
            <!-- /.cart-total -->
        </div>
    </div>
    <!-- /.cart-section -->
@endsection