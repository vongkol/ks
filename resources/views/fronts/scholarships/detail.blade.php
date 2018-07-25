@extends('layouts.front')
@section('content')
    <div class="box-head top-head">
        <h3 class="head-title text-center">Scholarship Detail</h3>
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
                                        <a href="#">{{$c->name}}</a>
                                        <ul>
                                            @foreach($subs as $s)
                                            <?php $counter2 = DB::table('scholarships')
                                                ->where('active',1)
                                                ->where('scholarship_category', $s->id)
                                                ->count();  
                                            ?>
                                                <li><a href="{{url('/scholarship/category/'.$s->id)}}">{{$s->name}} <span class="text-danger"> ({{$counter2}})</span></a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                 <li><a href="{{url('/scholarship/category/'.$c->id)}}">
                                    {{$c->name}} 
                                <span class="text-danger"> ({{$counter}})</span></a></li>
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
                            <img src="{{asset('uploads/scholarships/featured_image/'.$sch->featured_image)}}" width="100%" alt="">
                        </div>
                    </div>
                    <div class="col-sm-12" style="background: #fff">
                        <h3 class="text-gray">{{$sch->title}}</h3>
                        <div class="form-group row">
                            <label class="col-sm-2">School Name</label>
                            <div class="col-sm-10">
                               : 
                               <a href="{{url('/scholarship/detail/'.$sch->s_id)}}">{{$sch->name1}} / {{$sch->name2}}</a>
                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">Category</label>
                            <div class="col-sm-10">
                                : {{$sch->name}}
                            </div>
                        </div>
                    </div>
                </div>
               <div class="row">
                   <div class="col-sm-12" style="background: #fff">
                        <strong>Scholarship Description</strong>
                        <hr>
                        {!!$sch->description!!}
                        <p></p>
                   </div>
               </div>
            </div>
       
        </div>
    </div>
    <p></p>
    @endsection