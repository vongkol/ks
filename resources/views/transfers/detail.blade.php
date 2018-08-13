@extends("layouts.business")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Detail Business Transfer</strong>&nbsp;&nbsp;
          <a href="{{url('/admin/transfer')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a> |  <a href="{{url('/admin/business-transfer/edit/'.$business_transfer->id)}}" class="text-danger"><i class="fa fa-pencil"></i><b> Edit</b></a> 
            <hr>
            @if(Session::has('sms'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('sms')}}
                    </div>
                </div>
            @endif
            @if(Session::has('sms1'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('sms1')}}
                    </div>
                </div>
            @endif
            <form class="form-horizontal">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                            <label class="control-label col-sm-9 lb">
                               : {{$business_transfer->title}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 lb">Short Description </label>
                            <label class="control-label col-sm-9 lb">
                            : {{$business_transfer->short_description}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="website" class="control-label col-sm-3 lb">Owner</label>
                            <label  class="control-label col-sm-9 lb">
                            : {{$business_transfer->username}}
                            </label>
                        </div>                     
                    </div>
                    <div class="col-sm-6">
                            <div class="form-group row">
                                    <label class="control-label col-sm-2 lb">Category </label>
                                    <labe class="control-label col-sm-9 lb">
                                    : {{$business_transfer->name}}
                                    </label>
                                </div>
                        <div class="form-group row">
                            <label for="logo" class="control-label col-sm-2 lb">Featured Image</label>
                            <div class="col-sm-9">
                                <img src="{{asset('uploads/business_transfers/'.$business_transfer->featured_image)}}" alt="" width="150" id="preview">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                      <hr>
                            <strong>Description</strong>
                     <hr>   
                        <label class="control-label col-sm-12 lb">
                        {!!$business_transfer->description!!}
                        </label>
                    <hr>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection