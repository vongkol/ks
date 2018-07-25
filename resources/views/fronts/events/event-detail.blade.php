@extends('layouts.front')
@section('content')
<style>
     .price {
        padding: 5px 15px;
        font-weight: 700;
        float: right;
    }
    .text-gray {
        font-size: 17px;
    }
</style>
<div class="box-head top-head">
    <h3 class="head-title text-center">
         Event Detail
    </h3>
</div>
<div class="container">
    <div class="row">
    <div class="col-md-3">
            <div id='cssmenu'>
                <ul>
                    @foreach($event_categories as $e)
                        <?php
                            $counter = DB::table('events')
                                ->where('active',1)
                                ->where('event_category', $e->id)
                                ->count();
                            $subs = DB::table('event_categories')
                                ->where('active', 1)
                                ->where('parent_id', $e->id)
                                ->get();
                            
                        ?>
                            @if(count($subs)>0)
                                <li class="has-sub">
                                    <a href="#">{{$e->name}}</a>
                                    <ul>
                                        @foreach($subs as $s)
                                            <?php $counter2 = DB::table('events')
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
                                    <a href="{{url('/event-list/'.$e->id)}}"> 
                                        
                                        {{$e->name}}  <span class="text-danger"> ({{$counter}})</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="company-cat h-100">
                    <div class="product-img">
                        <img src="{{asset('/uploads/events/featured_image/'.$event->featured_image)}}" width="100%" alt="">
                    </div>
                    <div class="col-md-12">
                        <h1> {{$event->title}}</h1>
                        <div class="text-gray">
                            <i class="fa fa-calendar-check-o text-info" ></i> 
                            {{$event->event_date}} 
                            <i class="fa fa-clock-o text-info" ></i> 
                            {{$event->start_time }}  <b>-</b> {{$event->end_time }} 
                            <label class="price float-right"> 
                                @if($event->price <= 0)                
                                    Free
                                @else 
                                    $ {{$event->price}}
                                @endif
                            </label>
                        </div>
                        <div class="text-gray">
                            <i class="fa fa-map-marker text-info"></i> {{$event->location}}
                        </div>
                        <div class="text-gray">
                            <i class="fa fa-user text-info"></i> 
                            <b>{{$event->event_organizor}}</b> 
                            <a class="btn btn-success btn-xs float-right" href="{{$event->register_link}}">Register Now</a> 
                        </div>
                        <hr>
                        <aside>{!!$event->description!!}</aside>
                        <hr>
                        <div>
                            @if($event->map!==null)
                            <iframe src="{{$event->map}}" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
    
</div>
@endsection