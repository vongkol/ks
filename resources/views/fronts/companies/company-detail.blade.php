@extends('layouts.front')
@section('content')
<div class="box-head top-head">
    <h3 class="head-title text-center">Company Detail</h3>
</div>
<p></p>
<div class="container">
<div class="company-cat">
    <div class="row" >
            <div class="col-md-3">
                <div align="center">
                    <p></p>
                <img src="{{url('/uploads/companies/logo/'.$company->logo)}}" alt="" width="140">
                        <h4 class="text-danger"> <p></p>{{$company->name}}</h4>
                </div>
            </div>
            <div class="col-md-9">
                <p></p>
                <div class="col-md-12">
                        Office Email :&nbsp;&nbsp; <span class="text-danger">{{$company->office_email}}</span>
                </div>
                <div class="col-md-12">
                        Office Phone :&nbsp;&nbsp;<span class="text-danger">{{$company->office_phone}}</span>
                </div>
                <div class="col-md-12">
                        Business Type :&nbsp;&nbsp; <span class="text-danger">{{$business_type->name}}</span>
                </div>
                <div class="col-md-12">
                    Link to Profile :&nbsp;&nbsp; <a href="{{$company->website}}" target="_blank"><span class="text-danger">{{$company->website}}</span></a>
                </div>
                <div class="col-md-12">
                    Address :&nbsp;&nbsp; <span class="text-danger">{{$company->address}}</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-12">
                    <hr>
                        <h5 align="center">Company Profile </h5>
                    <hr>
                      {!!$company->profile!!}
                </div>
            </div>
        </div>
    </div>
</div>
<p></p>
@endsection