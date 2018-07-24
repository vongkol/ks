@extends('layouts.front')
@section('content')
<div class="box-head top-head">
    <h3 class="head-title text-center"><img src="{{asset('uploads/schools/icon/'.$school_category->icon)}}" alt="" width="25"> {{$school_category->name}} - School List</h3>
</div>
<div class="container">
    <div class="row" >
        <div class="col-md-3">
            <div id='cssmenu'>
                <ul>
                    @foreach($school_categories as $e)
                        <?php
                            $counter = DB::table('schools')
                                ->where('active',1)
                                ->where('school_category', $e->id)
                                ->count();
                            $subs = DB::table('school_categories')
                                ->where('active', 1)
                                ->where('parent_id', $e->id)
                                ->get();
                            
                        ?>
                            @if(count($subs)>0)
                                <li class="has-sub">
                                    <a href="#"><img src="{{asset('uploads/schools/icon/'.$e->icon)}}" width="25" alt="">  {{$e->name}}</a>
                                    <ul>
                                        @foreach($subs as $s)
                                            <?php $counter2 = DB::table('schools')
                                                ->where('active',1)
                                                ->where('school_category', $s->id)
                                                ->count();  
                                            ?>
                                            <li>
                                                <a href="{{url('/school-list/'.$s->id)}}">
                                                    <img src="{{asset('uploads/schools/icon/'.$e->icon)}}" width="25" alt="">
                                                    {{$s->name}} <span class="text-info">{{$counter2}}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{url('/school-list/'.$e->id)}}"> 
                                        <img src="{{asset('uploads/schools/icon/'.$e->icon)}}" width="25" alt=""> 
                                        {{$e->name}}  <span class="text-info">{{$counter}}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        <div class="col-md-9">
            <div class="row">
            @foreach($schools as $school)
            <div class="col-lg-4 col-md-4 col-sm-4 mb20 pd-0">
                <div class="product-block h-100">
                    <div class="product-img">
                        <a href="{{url('/school/detail/'.$school->id)}}"><img src="{{asset('/uploads/schools/logo/'.$school->logo)}}" width="150" alt=""></a>
                    </div>
                    <div align="left" class="product-content">
                        
                        <h5  class="text-center">
                        <a href="{{url('/school/detail/'.$school->id)}}">{{$school->name_khmer}}</a>
                        </h5>
                        <h5  class="text-center">
                        <a href="{{url('/school/detail/'.$school->id)}}">( {{$school->name_english}} )</a>
                        </h5>
                    </div>
                </div>
            </div>
            @endforeach  
            </div>
            <div class="row">
                <div class="col-md-12">
                {{$schools->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection