@extends('layouts.setting')
@section('content')
    <div class="row">
        <div class="col-sm-12">
                <strong>View Page</strong>&nbsp;&nbsp;
                <a href="{{url('admin/page')}}" class="btn btn-link btn-sm">Back To List</a>
                <hr>
                <div class="form-group row">
                        <label for="title" class="control-label col-lg-12 col-sm-12">
                            <p class="text-primary">Title</p>
                            <p>{{$page->title}}</p>
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="url" class="control-label col-lg-12 col-sm-12">
                            <p class="text-primary">URL</p>
                            <p>{{$page->url}}</p>
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="control-label col-lg-12 col-sm-12">
                            <p class="text-primary">Description</p>
                            <p>{!!$page->description!!}</p>
                        </label>
                    </div>       
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_page").addClass("current");
        })
    </script>
@endsection