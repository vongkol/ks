@extends('layouts.front')
@section('meta')
<meta name="description" content="{{$review->title}} - {{$review->name}}">
@endsection
@section('content')
    <div class="box-head top-head">
        <h3 class="head-title text-center">Review Detail</h3>
    </div>
    <?php
        $categories = DB::table('review_categories')
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
                                    $subs = DB::table('review_categories')
                                        ->where('active', 1)
                                        ->where('parent_id', $c->id)
                                        ->get();
                                ?>
                                @if(count($subs)>0)
                                    <li class="has-sub">
                                        <a href="#">{{$c->name}}</a>
                                        <ul>
                                            @foreach($subs as $s)
                                                <li><a href="{{url('/review/category/'.$s->id)}}">{{$s->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                 <li><a href="{{url('/review/category/'.$c->id)}}">{{$c->name}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.sidenav-section -->
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    <div class="col-sm-12" style="background: #fff">
                        <h3 class="text-primary">{{$review->title}}</h3>
                        <hr>
                        <div class="form-group row">
                            <label class="col-sm-2">Category</label>
                            <div class="col-sm-10">
                               : {{$review->name}}
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" style="background: #fff;">
                        {!!$review->description1!!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" style="background: #fff;">
                        {!!$review->description2!!}
                    </div>
                </div>
                <div class="row">
                        <div class="col-sm-12">
                            <p>&nbsp;</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="fb-share-button" data-href="{{url('/review/detail/'.$review->id)}}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url('/review/detail/'.$review->id)}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                        </div>
                    </div>
            </div>
       
        </div>
    </div>
    <p></p>
    @endsection