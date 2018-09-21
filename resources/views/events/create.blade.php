@extends("layouts.event")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Create New Event</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/event')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('/admin/event/save')}}" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="title" class="control-label col-sm-3 lb">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="title" name="title" value="{{old('title')}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="event_date" class="control-label col-sm-3 lb">Event Date <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="event_date" placeholder="01, Jul, 2018" name="event_date" value="{{old('event_date')}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="start_time" class="control-label col-sm-3 lb">Start Time <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="start_time" placeholder="7:00 AM" name="start_time" value="{{old('start_time')}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="end_time" class="control-label col-sm-3 lb">End Time <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="end_time" name="end_time" placeholder="5:00 PM" value="{{old('end_time')}}"  class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="price" class="control-label col-sm-3 lb">Price ($) </label>
                            <div class="col-sm-9">
                                <input type="text" step="0,1" id="price" required name="price" placeholder="0.00" value="{{old('price')}}"  class="form-control" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="control-label col-sm-3 lb">Location <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="location" name="location" class="form-control" required value="{{old('location')}}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="event_organizor" class="control-label col-sm-3 lb">Event Organizor</label>
                            <div class="col-sm-9">
                                <input type="text" id="event_organizor" placeholder="Mr.Jonh" value="{{old('event_organizor')}}"  name="event_organizor" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="event_category" class="control-label col-sm-3 lb">Event Category </label>
                            <div class="col-sm-9">
                                <select name="event_category" id="event_category" class="form-control sl">
                                    @foreach($event_categories as $event_category)
                                        <option value="{{$event_category->id}}">{{$event_category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="map" class="control-label col-sm-2 lb">Link Map</label>
                            <div class="col-sm-12">
                                <input type="text" id="map" name="map" value="{{old('map')}}"  class="form-control" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="regitster_link" class="control-label col-sm-2 lb">Register Link</label>
                            <div class="col-sm-12">
                                <input type="text" id="register_link" value="{{old('register_link')}}"  name="register_link" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <label for="description" class="control-label col-sm-12 lb" style="padding:0;">Description</label>
                                <textarea name="description" id="description" value="{{old('description')}}"  rows="4" class="ckeditor form-control"></textarea>
                            </div>
                            <div class="col-sm-3">
                                <label for="featured_image" class="control-label lb" style="padding:0;">Featured Image <span class="text-danger">(1200x600)</span></label>
                                <input type="file" value="" name="featured_image" id="featured_image" class="form-control" required onchange="loadFile(event)">
                                <br>
                                <img src="{{asset('uploads/events/featured_image/default.svg')}}" alt="" width="100%" id="preview">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group row">
                      
                            <div class="col-sm-9">
                            <p></p>
                                <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                            <p></p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset("ckeditor/ckeditor.js")}}"></script>
    <script>
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#event").addClass("current");
        })
        var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

  CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_event").addClass("current");
        })
    </script>
@endsection
