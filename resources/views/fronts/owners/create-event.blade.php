@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">
            <p></p>
            <h3 class="text-primary">Create New Event <a href="{{url('/owner/event')}}" class="btn btn-success btn-xs">Back</a></h3>
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
            <form action="{{url('/owner/event/save')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-7">
                   
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="title" class="control-label col-sm-3">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="title" value="{{old('title')}}" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Event Category <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="category" id="category" class="form-control">
                                    @foreach($categories as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="event_date" class="control-label col-sm-3">Event Date</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Jul, 01, 2018"  name="event_date" value="{{old('event_date')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Price <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="texxt" name="price" placeholder="1.00"  value="{{old('price')}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="start_time" class="control-label col-sm-3">Start Time <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="start_time" placeholder="7:00 AM"  value="{{old('start_time')}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="end_time" class="control-label col-sm-3">End Time <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="end_time" placeholder="5:00 PM"  value="{{old('end_time')}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="event_organizor" class="control-label col-sm-3">Event Organizor</label>
                            <div class="col-sm-9">
                                <input type="text" name="event_organizor" value="{{old('event_organizor')}}" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="col-sm-5">
                    <h4>Featured Image <span class="text-danger">(1200x600)</span></h4>
                    <img src="{{asset('uploads/events/featured_image/default.png')}}" alt="Photo" width="130" id="img">
                    <p></p>
                    <p>
                        <input type="file" name="featured_image" onchange="loadFile(event)">
                    </p>
                </div>
            </div>
            <div class="form-group row">
                <label for="map" class="control-label col-sm-3">Google Map Link</label>
                <div class="col-sm-12">
                    <input type="text" name="map" id="map" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="register_link" class="control-label col-sm-3">Register Link</label>
                <div class="col-sm-12">
                    <input type="text" name="register_link" id="register_link" value="{{old('register_link')}}" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4>Event Description</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p></p>
                    <button class="btn btn-primary btn-xs" type="submit">Save</button>
                </div>
            </div>
            </form>
       </div>
   </div>
@endsection
@section('js')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        function loadFile(e){
            var output = document.getElementById('img');
            
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

  CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
    </script>
@endsection