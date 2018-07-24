@extends('layouts.front')
@section('content')
    <div class="box-head top-head">
        <h3 class="head-title text-center">Product List</h3>
    </div>
    <?php
        $categories = DB::table('product_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->where('parent_id', 0)
            ->get();
    ?>
    <div class="container">
        <p></p>
        <div class="row">
            <div class="col-md-3">
        
            <div id='cssmenu'>
            <ul>
                @foreach($categories as $c)
                    <?php
                     $counter = DB::table('products')
                        ->where('active',1)
                        ->where('category_id', $c->id)
                        ->count();
                        $subs = DB::table('product_categories')
                            ->where('active', 1)
                            ->where('parent_id', $c->id)
                            ->get();
                    ?>
                    @if(count($subs)>0)
                        <li class="has-sub">
                            <a href="#"> <img src="{{asset('uploads/product-categories/'.$c->icon)}}" alt=""> {{$c->name}}</a>
                            <ul>
                                @foreach($subs as $s)
                                <?php $counter2 = DB::table('products')
                                    ->where('active',1)
                                    ->where('category_id', $s->id)
                                    ->count();  
                                ?>
                                    <li><a href="{{url('/product/category/'.$s->id)}}">{{$s->name}} <span class="text-danger"> ({{$counter2}})</span></a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                     <li><a href="{{url('/product/category/'.$c->id)}}"><img src="{{asset('uploads/product-categories/icon/'.$c->icon)}}" alt=""> {{$c->name}} 
                    <span class="text-danger"> ({{$counter}})</span></a></li>
                    @endif
                @endforeach
            </ul>
        </div>
        <!-- /.sidenav-section -->
</div>
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    @foreach($products as $p)
                        <div class="col-lg-4 col-md-4 col-sm-4 mb20 pd-0">
                            <div class="product-block h-100">
                            <div class="image-event">
                            <a href="{{url('/product/'.$p->id)}}">
                            <img src="{{asset('uploads/products/featured/'.$p->featured_image)}}" width="100%" alt=""></a>
                        </div>
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
                <div class="row">
                    <div class="col-sm-12">
                        {{$products->links()}}
                    </div>
                </div>
            </div>
       
        </div>
    </div>
    <p></p>
    @endsection