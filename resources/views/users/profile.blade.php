@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <strong>Profile [{{Auth::user()->email}}]</strong>&nbsp;&nbsp;
            <a href="{{url('/user/edit/'.$user->id)}}" class="text-danger"><i class="fa fa-pencil"></i> Edit</a>
            <hr>
           <div class="row">
               <div class="col-sm-6">
                   <div class="form-group row">
                       <label class="control-label col-sm-3">User ID</label>
                       <div class="col-sm-9">
                           : {{$user->id}}
                       </div>
                   </div>
                   <div class="form-group row">
                       <label class="control-label col-sm-3">First Name</label>
                       <div class="col-sm-9">
                           : {{$user->first_name}}
                       </div>
                   </div>
                   <div class="form-group row">
                       <label class="control-label col-sm-3">Last Name</label>
                       <div class="col-sm-9">
                           : {{$user->last_name}}
                       </div>
                   </div>
                   <div class="form-group row">
                       <label class="control-label col-sm-3">Gender</label>
                       <div class="col-sm-9">
                           : {{$user->gender}}
                       </div>
                   </div>
                   <div class="form-group row">
                       <label class="control-label col-sm-3">Username</label>
                       <div class="col-sm-9">
                           : {{$user->username}}
                       </div>
                   </div>
                   <div class="form-group row">
                       <label class="control-label col-sm-3">Role</label>
                       <div class="col-sm-9">
                           : {{$role_name->name}}
                       </div>
                   </div>
               </div>
               <div class="col-sm-6">
                   <div class="form-group row">
                       <label class="control-label col-sm-3">Email</label>
                       <div class="col-sm-9">
                           : {{$user->email}}
                       </div>
                   </div>
                   <div class="form-group row">
                       <label class="control-label col-sm-3">Phone Number</label>
                       <div class="col-sm-9">
                           : {{$user->phone}}
                       </div>
                   </div>
                   <div class="form-group row">
                       <label class="control-label col-sm-3"></label>
                       <div class="col-sm-9">
                           <br>
                           <img src="{{asset('profile/'.$user->photo)}}" alt="Photo" width="120">
                       </div>
                   </div>
               </div>
           </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#user").addClass("current");
        });
    </script>

@endsection