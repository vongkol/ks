@extends("layouts.customer")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Product Newsletter</strong>&nbsp;&nbsp;
            
            <hr>
            <h4>
                Please click the button below to send product newsletter to customer for this month!
            </h4>
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
            <p>
                <a href="{{url('/admin/product-newsletter/send')}}" class="btn btn-success btn-sm">Send Product Newsletter Now</a>
            </p>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_product_newsletter").addClass("current");
        })
    </script>
@endsection