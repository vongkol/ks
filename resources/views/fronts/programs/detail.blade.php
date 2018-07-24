@extends('layouts.front')
@section('content')
<div class="box-head top-head">
    <h3 class="head-title text-center">School Program Detail</h3>
</div>
<?php
        $categories = DB::table('program_categories')
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
                                 $counter = DB::table('school_programs')
                                 ->where('active',1)
                                 ->where('program_category', $c->id)
                                 ->count();  
                                    $subs = DB::table('program_categories')
                                        ->where('active', 1)
                                        ->where('parent_id', $c->id)
                                        ->get();
                                ?>
                                @if(count($subs)>0)
                                    <li class="has-sub">
                                        <a href="#"> <img src="{{asset('uploads/programs/icon/'.$c->icon)}}" alt=""> {{$c->name}}</a>
                                        <ul>
                                            @foreach($subs as $s)
                                                <?php $counter2 = DB::table('school_programs')
                              ->where('active',1)
                              ->where('program_category', $s->id)
                              ->count();   ?>
                                                <li><a href="{{url('/school-program/category/'.$s->id)}}">{{$s->name}} <span class="text-primary">{{$counter2}}</span></a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                 <li><a href="{{url('/school-program/category/'.$c->id)}}"><img src="{{asset('uploads/programs/icon/'.$c->icon)}}" alt=""> {{$c->name}} <span class="text-primary">{{$counter}}</span></a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.sidenav-section -->
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    <div class="col-md-12 pd-0" style="background: #fff">
                        <div class="product-img">
                            <img src="{{asset('uploads/school_programs/featured_image/'.$program->featured_image)}}" width="100%" alt="">
                        </div>
                 
                        <div class="col-md-12">
                            <h3 class="text-gray">{{$program->title}}</h3>
                            <div class="form-group row">
                                <label class="col-sm-2">School Name</label>
                                <div class="col-sm-10">
                                : 
                                <a href="{{url('/school/detail/'.$program->s_id)}}">{{$program->name1}} / {{$program->name2}}</a>
                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Category</label>
                                <div class="col-sm-10">
                                    : {{$program->cat_name}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <div class="row">
                   <div class="col-sm-12" style="background: #fff">
                        <strong>Program Description</strong>
                        <hr>
                        {!!$program->description!!}
                        <p></p>
                   </div>
               </div>
            </div>
       
        </div>
    </div>
    <p></p>
    @endsection