@extends("layouts.event")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Event Detail</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/event')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>&nbsp;&nbsp; |  &nbsp;&nbsp;<a class="text-danger" href="{{url('/admin/event/edit/'.$event->id)}}" title="Edit"><i class="fa fa-pencil"></i> Edit</a> 
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
                       <input type="hidden" name="id" value="{{$event->id}}">
                        <div class="form-group row">
                            <label for="title" class="control-label col-sm-3 lb">Title <span class="text-danger">*</span></label>
                            <label for="title" class="control-label col-sm-9 lb">
                              : {{$event->title}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="event_date" class="control-label col-sm-3 lb">Event Date <span class="text-danger">*</span></label>
                            <label for="event_date" class="control-label col-sm-3 lb">
                               : {{$event->event_date}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="start_time" class="control-label col-sm-3 lb">Start Time <span class="text-danger">*</span></label>
                            <label for="start_time" class="control-label col-sm-9 lb">
                               : {{$event->start_time}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="end_time" class="control-label col-sm-3 lb">End Time <span class="text-danger">*</span></label>
                            <label class="control-label col-sm-9 lb">
                               : {{$event->end_time}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="price" class="control-label col-sm-3 lb">Price ($)</label>
                            <label class="control-label col-sm-9 lb">
                                : {{$event->price}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="control-label col-sm-3 lb">Location <span class="text-danger">*</span></label>
                            <label class="control-label col-sm-9 lb">
                                : {{$event->location}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="event_organizor" class="control-label col-sm-3 lb">Event Organizor</label>
                            <label class="control-label col-sm-9 lb">
                                : {{$event->event_organizor}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="event_category" class="control-label col-sm-3 lb">Event Category </label>
                            <label class="control-label col-sm-9 lb">
                                : {{$event_category->name}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="map" class="control-label col-sm-12 lb">Link Map :   {{$event->map}}</label>
                        </div>
                        <div class="form-group row">
                            <label for="register_link" class="control-label col-sm-12 lb">Register Link : {{$event->register_link}}</label>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <label for="description" class="control-label col-sm-12 lb" style="padding:3px;"><b>Description</b></label>
                                <hr><label class="control-label col-sm-12 lb">
                                    {!!$event->description!!}
                                </label>
                            </div>
                            <div class="col-sm-3">
                            <label class="control-label col-sm-12 lb"> <b>Featured Image</b></label>
                                <img src="{{asset('uploads/events/featured_image/'.$event->featured_image)}}" alt="" width="100%" id="preview">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_event").addClass("current");
        })
    </script>
@endsection