@extends("layouts.company")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Detail Company</strong>&nbsp;&nbsp;
          <a href="{{url('/admin/company')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a> |  <a href="{{url('/admin/company/edit/'.$company->id)}}" class="text-danger"><i class="fa fa-pencil"></i><b> Edit</b></a> 
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
                               : {{$company->name}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="business_type" class="control-label col-sm-3 lb">Business Type </label>
                            <label class="control-label col-sm-9 lb">
                                : 
                                @foreach($business_types as $b)
                                    @if($b->id==$company->business_type)
                                        {{$b->name}}
                                    @endif
                                @endforeach
                            </label>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 lb">Address</label>
                            <label class="control-label col-sm-9 lb">
                               : {{$company->address}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="office_phone" class="control-label col-sm-3 lb">Office Phone</label>
                            <label class="control-label col-sm-9 lb">
                               : {{$company->office_phone}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="office_email" class="control-label col-sm-3 lb">Office Email</label>
                            <label class="control-label col-sm-9 lb">
                                : {{$company->office_email}}
                            </label>
                        </div>
                       
                        <div class="form-group row">
                            <label for="website" class="control-label col-sm-3 lb">Website URL</label>
                            <label  class="control-label col-sm-9 lb">
                                : {{$company->website}}
                            </label>
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                            <div class="form-group row">
                                    <label class="control-label col-sm-2 lb">Category </label>
                                    <labe class="control-label col-sm-9 lb">
                                        : 
                                        @foreach($categories as $b)
                                            @if($b->id==$company->category_id)
                                                {{$b->name}}
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                        <div class="form-group row">
                            <label for="logo" class="control-label col-sm-2 lb">Logo</label>
                            <div class="col-sm-9">
                                <img src="{{asset('uploads/companies/logo/'.$company->logo)}}" alt="" width="72" id="preview">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                      <hr>
                            <strong>Company Profile</strong>
                     <hr>   
                        <label class="control-label col-sm-12 lb">
                        {!!$company->profile!!}
                        </label>
                    <hr>
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
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_company").addClass("current");
        });
        var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

  CKEDITOR.replace( 'profile',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
    
    </script>
@endsection