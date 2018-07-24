@extends('layouts.front')
@section('content')
<!-- sign-up form -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5">
                <h3 class="mb10">Create Your Account</h3>
                <p>Please fill all Resgister form Fields Below. </p>
                <form>
                    <div class="form-group">
                        <label class="control-label sr-only" for="name">

                        </label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Enter Your Name"  required>
                    </div>
                    <div class="form-group">
                        <label class="control-label sr-only" for="phone"></label>
                        <input id="phone" name="phone" type="text" class="form-control" placeholder="Phone Number"  required>
                    </div>
                    <div class="form-group">
                        <label class="control-label sr-only" for="email"></label>
                        <input id="email" name="emaol" type="text" class="form-control" placeholder="Enter your email id"  required>
                    </div>
                    <div class="form-group">
                        <label class="control-label  sr-only" for="password"></label>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Create your password"  required>
                    </div>
                    <div class="form-group">
                        <label class="control-label  sr-only" for="cpassword"></label>
                        <input id="cpassword" name="cpassword" type="cpassword" class="form-control" placeholder="Comfirm password"  required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mb10">Register</button>
                    <div>
                        <p>Have an Acount? <a href="#">Login</a></p>
                    </div>
                </form>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 ">
                <div class="feature-content">
                    <h4> 
                        What you want to post? <img src="{{asset('front/images/feature_icon_2.png')}}" alt="">
                    </h4>
                    <aside>
                        <input type="checkbox" id="subscribeNews" name="subscribe" value="Product">
                        <label>Product</label>
                    </aside>
                    <aside>
                        <input type="checkbox" id="education" name="education" value="Education">
                        <label>Education</label>
                    </aside>
                    <aside>
                        <input type="checkbox" id="event" name="event" value="Event">
                        <label>Event</label>
                    </aside>
                    <aside>
                        <input type="checkbox" id="company" name="company" value="Company">
                        <label>Company</label>
                    </aside>
                    <aside>
                        <input type="checkbox" id="review" name="review" value="Review">
                        <label>Review</label>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection