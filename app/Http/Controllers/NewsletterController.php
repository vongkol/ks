<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function product()
    {
        return view('newsletters.product');
    }
    public function event()
    {
        return view('newsletters.event');
    }
    public function send_product(Request $r)
    {
        // get all email address from customers
        $customers = DB::table('customers')->get();
        $arr = array();
        foreach($customers as $c)
        {
            // compose message body
            $logo = asset('newsletter/kspage_logo.png');
            $banner = asset('newsletter/banner_promotion.jpg');
            $all_url = url('/product-listing/');
            // get recommended product each customer
            $m = date('m')-1;
            $y = date('Y');
            $sql = "
                    select count(id) as counter, product_id from customer_histories where customer_id=$c->id 
                    and month(create_at)>=$m and year(create_at)=$y  
                    group by product_id order by counter desc limit 8
                ";
            $ps = DB::select($sql);
            $products=[];
            if($ps!=null)
            {
                // select top 10 product id
                $arr = array();
                foreach($ps as $h)
                {
                    array_push($arr, $h->product_id);
                }
                $products = DB::table('products')->whereIn('id', $arr)->get();
            }
            $div = "";
          
            foreach($products as $p)
            {
                $src = asset('uploads/products/featured/'.$p->featured_image);
                $a = url('/product/'.$p->id);

                $div .="<div class='col-md-3' style='width:200px;display:inline-block'>
                    <img src='{$src}' style='width: 170px'>
                    <p style='font-weight:bold;text-align:center'><a href='{$a}' target='_blank'>{$p->name}</a></p>
                    <p style='margin-top:-3px;text-align:center;color:red;'>$ {$p->sell_price}</p>
                </div>";

            }
            $sms =<<<EOT
            <!DOCTYPE html>
            <html>
            <head>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
                <title></title>
            
                <style type="text/css">
                    body { font-family: 'Montserrat', sans-serif; }
                    p { font-size: 12px; }
                    a { color: #333333; }
                </style>
            </head>
            <body>
                <div class="main-container" style="float:left; background: #ddd; width: 100%; max-width: 700px; padding: 15px;">
                    <div class="container" style="width: 100%; background-color: #fff; padding: 15px;">
                        <div class="header">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{$logo}" style="width: 120px;">
                                </div>
                                <div class="col-md-8 text-right">
                                    <a href="#"><i class="fa fa-facebook" style="color:#888;"></i></a> &nbsp;
                                    <a href="#"><i class="fa fa-instagram" style="color:#888;"></i></a> &nbsp;
                                    <a href="#"><i class="fa fa-linkedin" style="color:#888;"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="content" style="margin-top: 15px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="#"><img src="{$banner}" style="width: 100%;"></a>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <!-- Most Selling product -->
                                <div class="col-md-12">
                                    <h2 class="text-center" style="color:#888;text-align:center">Products That You May Interest
                                        <a href="{$all_url}"><span style="font-size: 10px;">(View All)</span></a>
                                    </h2><hr>
                                    <div class="row">
                                        {$div}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer" style="background: #000; padding: 15px;">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center" style="color: #fff;">&copy;2018 www.kspage.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
            </html>
        

EOT;
            if($products!=null)
            {
                Right::send_email($c->email, "Product Newsletter", $sms);
            }
        }
        $r->session()->flash('sms', 'Newsletter has been sent!');
        return redirect('/admin/product-newsletter');
    }
    public function send_event(Request $r)
    {
        // get all email address from customers
        $customers = DB::table('customers')->get();
        $arr = array();
        foreach($customers as $c)
        {
            // compose message body
            $logo = asset('newsletter/kspage_logo.png');
            $banner = asset('newsletter/banner_promotion.jpg');
            $all_url = url('/event/all/');
            // get recommended product each customer
            $m = date('m')-1;
            $y = date('Y');
            $sql = "
                    select count(id) as counter, category_id from event_histories where customer_id=$c->id 
                    and month(create_at)>=$m and year(create_at)=$y  
                    group by category_id order by counter desc limit 8
                ";
            $ps = DB::select($sql);
            $products=[];
            if($ps!=null)
            {
                // select top 10 product id
                $arr = array();
                foreach($ps as $h)
                {
                    array_push($arr, $h->category_id);
                }
                $products = DB::table('events')->whereIn('event_category', $arr)->where('active',1)->get();
            }
            $div = "";
          
            foreach($products as $p)
            {
                $src = asset('uploads/events/featured_image/small/'.$p->featured_image);
                $a = url('/event/detail/'.$p->id);
                $price = $p->price;
                $date = $p->event_date;
                $div .="<div class='col-md-6' style='display:inline-block'>
                <div style='float: left; width: 100%; background: #fff; border: 1px solid #ddd; box-shadow: 0 1px 2px 0 rgba(32,48,60,.14), 0 3px 3px 0 rgba(32,48,60,.06);'>
                    <a href='{$a}'>
                        <div style='float:left; z-index: 100; position: absolute; background: #f96464; color: #fff; width: 70px; padding: 3px 3px 3px 10px; bottom: 75px;'><p style='margin: 0px;'>Price: {$price}</p></div>

                        <div style='float:right; z-index: 100; position: absolute; background: green; color: #fff; width: 70px; padding: 3px 3px 3px 10px; bottom: 75px;'><p style='margin: 0px;'>{$date}</p></div>
                        <div style='position: relative;'>
                            <img src='{$src}' style='width: 300px;'>
                        </div>

                        <div class='event-title' style='padding: 5px 10px 0px 10px;'>
                            <h4 style='font-weight: bold;'>{$p->title}</h4>
                            <div class='row'>
                                <div style='display:inline-block'>
                                   Location: {$p->location}
                                </div>
                               
                            </div>
                            
                        </div>
                    </a>
                </div>
            </div>";

            }
            $sms =<<<EOT
            <!DOCTYPE html>
            <html>
            <head>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
                <title></title>
                <style type="text/css">
                    body { font-family: 'Montserrat', sans-serif; }
                    p { font-size: 12px; }
                    a { color: #333333; }
                </style>
            </head>
            <body>
                <div class="main-container" style="float:left; background: #ddd; width: 100%; max-width: 700px; padding: 15px;">
                    <div class="container" style="width: 100%; background-color: #fff; padding: 15px;">
                        <div class="header">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{$logo}" style="width: 120px;">
                                </div>
                                <div class="col-md-8 text-right">
                                    <a href="#"><i class="fa fa-facebook" style="color:#888;"></i></a> &nbsp;
                                    <a href="#"><i class="fa fa-instagram" style="color:#888;"></i></a> &nbsp;
                                    <a href="#"><i class="fa fa-linkedin" style="color:#888;"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="content" style="margin-top: 15px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="#"><img src="{$banner}" style="width: 100%;"></a>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <!-- Most Selling product -->
                                <div class="col-md-12">
                                    <h2 class="text-center" style="color:#888;text-align:center">Lastest Events You May Interest
                                        <a href="{$all_url}"><span style="font-size: 10px;">(View All)</span></a>
                                    </h2><hr>
                                    <div class="row">
                                        {$div}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer" style="background: #000; padding: 15px;">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center" style="color: #fff;">&copy;2018 www.kspage.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
            </html>
EOT;
            if($products!=null)
            {
                Right::send_email($c->email, "Event Newsletter", $sms);
            }
        }
        $r->session()->flash('sms', 'Newsletter has been sent!');
        return redirect('/admin/event-newsletter');
    }
}
