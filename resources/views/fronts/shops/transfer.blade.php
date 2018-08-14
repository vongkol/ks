@extends('layouts.front')
@section('content')
    <div class="box-head top-head">
        <h3 class="head-title text-center">Business Transfer</h3>
    </div>
    <?php
        $categories = DB::table('transfers_categories')
            ->where('active', 1)
            ->orderBy('name')
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
                     $counter = DB::table('business_transfers')
                        ->where('active',1)
                        ->where('category_id', $c->id)
                        ->count();
                    ?>
                   
                     <li><a href="{{url('/business/category/'.$c->id)}}">
                        
                        {{$c->name}} 
                    <span class="text-danger"> ({{$counter}})</span></a></li>
                    
                @endforeach
            </ul>
        </div>
        <!-- /.sidenav-section -->
</div>
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    @foreach($transfers as $p)
                        <div class="col-lg-4 col-md-4 col-sm-4 mb20 pd-0">
                            <div class="product-block h-100">
                            <div class="image-event">
                            <a href="{{url('/business/detail/'.$p->id)}}">
                            <img src="{{asset('uploads/business_transfers/'.$p->featured_image)}}" width="100%" alt=""></a>
                        </div>
                        <div class="product-content">
                                <p><a href="{{url('/business/detail/'.$p->id)}}" class="product-title"><strong>{{$p->title}}</strong></a></p>
                                <div class="product-meta">
                                   {{$p->short_description}}
                                </div>
                                <div class="shopping-btn">
                                    <a href="{{url('business/detail/'.$p->id)}}" class="btn btn-success btn-xs">View Detail</a>
                                </div>
                                
                            </div>
                        </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        {{$transfers->links()}}
                    </div>
                </div>
            </div>
       
        </div>
    </div>
    <p></p>
    @endsection