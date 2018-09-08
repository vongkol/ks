<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Customer Management | Kspage</title>
    <!-- Styles -->
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/datepicker.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{asset("chosen/chosen.css")}}">
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/table.css")}}">
</head>
<body>
<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
    <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Kspage</a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{url('/home')}}">Home</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{url('/admin/product-management')}}">Products</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/admin/customer-management')}}">Customers <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/company-management')}}">Companies</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/business-transfer')}}">Business Transfer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/school-management')}}">Schools</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/review')}}">Reivews</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/event-management')}}">Events</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/setting')}}">Settings</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="nav1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{Auth::user()->username}}
                </a>
                <div class="dropdown-menu" aria-labelledby="nav1">
                    <a class="dropdown-item" href="{{url('/user/profile')}}"><i class="fa fa-user text-primary"></i> &nbsp;Profile</a>
                    <a href="{{url('/user/update-password/'.Auth::user()->id)}}" class="dropdown-item"><i class="fa fa-key text-warning"></i> &nbsp;Reset Password</a>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-sign-out text-success"></i> &nbsp;Logout</a>
                </div>
            </li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
            <ul class="nav nav-pills flex-column" id="siderbar">
                <li class="nav-item"><strong>Management</strong></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('admin/customer')}}" id="menu_customer">Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/shop-owner')}}" id="menu_shop_owner">Shop Owner</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/shop')}}" id="menu_shop">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/product-newsletter')}}" id="menu_product_newsletter">Product Newsletter</a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/event-newsletter')}}" class="nav-link" id="menu_event_newsletter">Event Newsletter</a>
                </li>
                <li class="nav-item">
                    <strong>Settings</strong>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/shop-category')}}" id="menu_shop_category">Shop Category</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/review-category')}}" id="menu_review_category">Review Category</a>
                </li> --}}
            </ul>
        </nav>
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2">
            @yield('content')
        </main>
    </div>
</div>
<!-- Scripts -->
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/tether.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
@yield('js')
</body>
</html>
