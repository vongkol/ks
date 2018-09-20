@extends('layouts.front')
@section('content')
   <div class="content bg-white">
       <div class="container">
            <p></p>
            <h3 class="text-primary">Edit My Profile</h3>
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
            <form action="{{url('/owner/profile/update')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-7">
                   
                        {{csrf_field()}}
                        <input type="hidden" value="{{$user->id}}" name="id">
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="first_name" value="{{$user->first_name}}" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Last Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$user->last_name}}" required name="last_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Gender</label>
                            <div class="col-sm-9">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="Male" {{$user->gender=='Male'?'selected':''}}>Male</option>
                                    <option value="Female" {{$user->gender=='Female'?'selected':''}}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" name="email" value="{{$user->email}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone" value="{{$user->phone}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address" value="{{$user->address}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">Username <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" value="{{$user->username}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3"><strong><u>What I will Post </u></strong></label>
                            <div class="col-sm-9">
                                <div>
                                    <input type="checkbox" value="1" name="post_product" id="post_product" {{$user->post_product?'checked':''}}>  &nbsp;
                                    <label for="post_product">
                                        Post Product
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" value="1" name="post_company" id="post_company" {{$user->post_company?'checked':''}}>  &nbsp;
                                    <label for="post_company">
                                        Post Company
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" value="1" name="post_event" id="post_event" {{$user->post_event?'checked':''}}>  &nbsp;
                                    <label for="post_event">
                                        Post Event
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" value="1" name="post_school" id="post_school" {{$user->post_school?'checked':''}}>  &nbsp;
                                    <label for="post_school">
                                        Post School
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" value="1" name="post_review" id="post_review" {{$user->post_review?'checked':''}}>  &nbsp;
                                    <label for="post_review">
                                        Post Review
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" value="1" name="post_transfer" id="post_transfer" {{$user->post_transfer?'checked':''}}>  &nbsp;
                                    <label for="post_transfer">
                                        Post Business Transfer
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="control-label col-sm-3">&nbsp;</label>
                            <div class="col-sm-9">
                                <button class="btn btn-primary btn-xs" type="submit">Save</button>
                            </div>
                        </div>
                </div>
                <div class="col-sm-5">
                    <h4>Profile Photo</h4>
                    <img src="{{asset('uploads/shop_owners/profile/'.$user->photo)}}" alt="Photo" width="130" id="img">
                    <p></p>
                    <p>
                        <input type="file" name="photo" onchange="loadFile(event)">
                    </p>
                </div>
            </div>
            </form>
       </div>
   </div>
   <script>
        function loadFile(e){
            var output = document.getElementById('img');
            
            output.src = URL.createObjectURL(e.target.files[0]);
        }
    </script>
@endsection