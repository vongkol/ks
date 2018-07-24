@extends('layouts.front')
@section('content')
<div class="box-head top-head">
    <h3 class="head-title text-center"><img src="{{asset('/uploads/companies/icon/'.$company_category->icon)}}" width="25" alt=""> {{$company_category->name}} - Company List</h3>
</div>
<div class="container">
    <div class="row" >
        @foreach($companies as $cl)
            <div class="col-md-6 mb20">
                <div class="card h-100">
                <div class="row">
                    <div class="col-md-3 image-company"> 
                        <div class="pd-5">
                            <a href="{{url('company-detail/'.$cl->id)}}"><img src="{{url('uploads/companies/logo/'.$cl->logo)}}" alt="" width="100%"></a>
                        </div>
                    </div>
                    <div class="col-md-9 pd-0">
                        <a href="{{url('company-detail/'.$cl->id)}}">
                        <aside class="cl text-danger">
                            {{$cl->name}}
                        </aside>
                        <aside class="text-gray">
                            <i class="fa fa-map-marker"></i> {{$cl->address}}
                        </aside>
                        <aside class="text-gray"> <i class="fa fa-phone"></i> {{$cl->office_phone}}</aside>
                        </a>
                    </div>
                </div>
                </div>
            </div>
        @endforeach
    </div><br>
    <div class="row">   
    {{$companies->links()}}
    </div>
</div>
@endsection