@extends("layouts.review")
@section('content')
    <div class="row">
        <div class="col-lg-12">
           <strong>Review Detail</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/review')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>&nbsp;&nbsp;
            <a href="{{url('/admin/review/edit/'.$review->id)}}" class="text-primary">Edit</a>&nbsp;&nbsp;
            <a href="{{url('/admin/review/delete/'.$review->id)}}" class="text-danger">Delete</a>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <p><strong>Title</strong></p>
            <p>{{$review->title}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <p><strong>Category Name</strong></p>
            <p>{{$review->name}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <p><strong>Featured Image</strong></p>
            <p><img src="{{asset('uploads/reviews/'.$review->featured_image)}}" alt="" width="150"></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <p><strong>Description 1</strong></p>
            {!!$review->description1!!}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <p><strong>Description 2</strong></p>
            {!!$review->description2!!}
        </div>
    </div>
@endsection
@section('js')
    
    <script>
       
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_review").addClass("current");
        });
      
    </script>
@endsection