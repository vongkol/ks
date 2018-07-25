@extends('layouts.front')
@section('content')
<div class="box-head top-head">
    <h3 class="head-title text-center">School Detail</h3>
</div>
<div class="container">
    <div class="row">
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
                                    <a href="#">
                                        {{$e->name}}</a>
                                    <ul>
                                        @foreach($subs as $s)
                                            <?php $counter2 = DB::table('schools')
                                                ->where('active',1)
                                                ->where('school_category', $s->id)
                                                ->count();  
                                            ?>
                                            <li>
                                                <a href="{{url('/school-list/'.$s->id)}}">
                                                    {{$s->name}} <span class="text-info">{{$counter2}}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{url('/school-list/'.$e->id)}}"> 
                                        {{$e->name}}  <span class="text-info">{{$counter}}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9 pd-0">
            <div class="company-cat">
                    <div class="row">
                            <div class="col-md-4">
                                <div align="center" style="padding: 10px;">
                                    <div class="image-event">
                                        <img src="{{url('uploads/schools/logo/'.$school->logo)}}" alt="" width="140">
                                    </div>
                                    <h5>{{$school->name_khmer}}</h5>
                                    <h5>( {{$school->name_english}} )</h5>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <p></p>
                                <div class="col-md-12">
                                        Email :&nbsp;&nbsp; <span class="text-primary">{{$school->email}}</span>
                                </div>
                                <div class="col-md-12">
                                        Phone : &nbsp;&nbsp;<span class="text-primary">{{$school->phone}}</span>
                                </div>
                                <div class="col-md-12">
                                        Address : &nbsp;&nbsp;<span class="text-primary"> {{$school->address}}</span>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                        <h5 align="center">School Profile </h5>
                                    <hr>
                                    {!!$school->profile!!}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection