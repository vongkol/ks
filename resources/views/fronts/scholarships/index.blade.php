@extends('layouts.front')
@section('content')
    <div class="box-head top-head">
        <h3 class="head-title text-center">Scholarship List</h3>
    </div>
    <?php
        $categories = DB::table('scholarship_categories')
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
                     $counter = DB::table('scholarships')
                        ->where('active',1)
                        ->where('scholarship_category', $c->id)
                        ->count();
                        $subs = DB::table('scholarship_categories')
                            ->where('active', 1)
                            ->where('parent_id', $c->id)
                            ->get();
                    ?>
                    @if(count($subs)>0)
                        <li class="has-sub">
                            <a href="#"> <img src="{{asset('uploads/programs/icon/'.$c->icon)}}" alt=""> {{$c->name}}</a>
                            <ul>
                                @foreach($subs as $s)
                                <?php $counter2 = DB::table('scholarships')
                                    ->where('active',1)
                                    ->where('scholarship_category', $s->id)
                                    ->count();  
                                ?>
                                    <li><a href="{{url('/scholarship/category/'.$s->id)}}">{{$s->name}} <span class="text-primary">{{$counter2}}</span></a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                     <li><a href="{{url('/scholarship/category/'.$c->id)}}"><img src="{{asset('uploads/programs/icon/'.$c->icon)}}" alt=""> {{$c->name}} 
                    <span class="text-primary"> {{$counter}}</span></a></li>
                    @endif
                @endforeach
            </ul>
        </div>
        <!-- /.sidenav-section -->
</div>
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    @foreach($scholarships as $p)
                        <div class="col-lg-4 col-md-4 col-sm-4 mb20 pd-0">
                            <div class="product-block h-100">
                            <div class="image-event">
                            <a href="{{url('/scholarship/detail/'.$p->id)}}">
                            <img src="{{asset('uploads/scholarships/featured_image/small/'.$p->featured_image)}}" width="100%" alt=""></a>
                        </div>
                                    <div class="product-content">
                                       <strong>
                                            <a href="{{url('/scholarship/detail/'.$p->id)}}" class="product-title">
                                                {{$p->title}}
                                            </a>
                                       </strong>
                                       <p class="text-left">
                                           By {{$p->name_english}}
                                       </p>
                                    </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        {{$scholarships->links()}}
                    </div>
                </div>
            </div>
       
        </div>
    </div>
    <p></p>
    @endsection