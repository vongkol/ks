@extends('layouts.front')
@section('content')
    <div class="box-head top-head">
        <h3 class="head-title text-center">School Program List</h3>
    </div>
    <?php
        $categories = DB::table('program_categories')
            ->where('active', 1)
            ->where('parent_id', 0)
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
                                    $subs = DB::table('program_categories')
                                        ->where('active', 1)
                                        ->where('parent_id', $c->id)
                                        ->get();
                                ?>
                                @if(count($subs)>0)
                                    <li class="has-sub">
                                        <a href="#">{{$c->name}}</a>
                                        <ul>
                                            @foreach($subs as $s)
                                                <li><a href="{{url('/school-program/category/'.$s->id)}}">{{$s->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                 <li><a href="{{url('/school-program/category/'.$c->id)}}">{{$c->name}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.sidenav-section -->
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    @foreach($programs as $p)
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-bottom: 7px">
                            <div class="product-block">
                                <div class="product-img">
                                    <a href="{{url('/program/detail/'.$p->id)}}"><img src="" width="100%" alt=""></a>
                                </div>
                                    <div class="product-content">
                                       <strong>
                                            <a href="{{url('/program/detail/'.$p->id)}}" class="product-title">
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
                        {{$programs->links()}}
                    </div>
                </div>
            </div>
       
        </div>
    </div>
    <p></p>
    @endsection