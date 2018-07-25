@extends('layouts.front')
@section('content')
<div class="box-head top-head">
    <h3 class="head-title text-center">Event List</h3>
</div>
<div class="container">
    <div class="row" >
        <div class="col-md-3">
            <div id='cssmenu'>
                <ul>
                @foreach($event_categories as $c)
                    <?php
                        $counter = DB::table('events')
                            ->where('active',1)
                            ->where('event_category', $c->id)
                            ->count();
                        $subs = DB::table('event_categories')
                            ->where('active', 1)
                            ->where('parent_id', $c->id)
                            ->get();
                    ?>
                        @if(count($subs)>0)
                            <li class="has-sub">
                                <a href="#"> 
                                  
                                    {{$c->name}}
                                </a>
                                <ul>
                                    @foreach($subs as $s)
                                        <?php 
                                            $counter2 = DB::table('events')
                                                ->where('active',1)
                                                ->where('event_category', $s->id)
                                                ->count();  
                                        ?>
                                        <li>
                                            <a href="{{url('/event-list/'.$s->id)}}"> 
                                                
                                                {{$s->name}} <span class="text-danger"> ({{$counter2}})</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                        <li> 
                            <a href="{{url('/event-list/'.$c->id)}}">
                                
                                {{$c->name}} <span class="text-danger"> ({{$counter}})</span>
                            </a>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                @foreach($events as $ev)
                <div class="col-md-4 col-sm-4 mb20 pd-0">
                    <div class="product-block h-100">
                        <div class="image-event">
                            <a href="{{url('/event/detail/'.$ev->id)}}">
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
            <div class="row">
                <div class="col-md-12">
                    {{$events->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection