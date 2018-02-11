@extends('layouts.app')

@section('content')
    <div id="header-wrapper" class="header-slider">
        <div class="container res-search-auto">
        <div class="row">
            <div class="col-md-12">
                <div id="main-flexslider" class="flexslider">
					<ul class="slides">
						<li>
						<p class="home-slide-content">
							Build Your <strong>Appetite </strong>
						</p>
						</li>
						<li>
						<p class="home-slide-content">
							Opt in to a <strong>Restaurant</strong>
						</p>
						</li>
						<li>
						<p class="home-slide-content">
							 Receive your  <strong> deal</strong>
						</p>
						</li>
					</ul>
				</div>
				<!-- end slider -->
			</div>

            </div>
            <div class="col-xs-12 col-md-8 col col-md-offset-2">
				@if($errors->any())
					<div class="alert alert-danger alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong>Error! </strong>{{$errors->first()}}
					</div>

				@endif
                <form action="{{ route('restaurants.search') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <select name="res_type" class="selectpicker">
                            <option value="restaurant">Restaurants</option>
                            <option value="takeaway">Takeaways</option>
                            <option value="cafe">Cafés & Bars</option>
                            <option value="dessert">Dessert Parlours</option>
                        </select>
                    <input value="{{ old('location') }}" name="location" type="text" class="form-control" placeholder="Search for restaurants by area or postcode...">
                    <span class="input-group-btn">
                        <button class="btn btn-white btn-primary" type="submit"> Search </button>
                    </span>
                    </div><!-- /input-group -->
                </form>
            </div><!-- /.col-lg-6 -->
        </div>
    </div>
<!-- spacer section -->
<section id="hiw" class="section spacer">
<div class="container">
	<h4>
		How it works?
	</h4>

	<div class="row">

		<div class="col-md-4 hiw">
			<br>
			<img width="80px" src="/images/menu.png" alt=""><br><br>
			<span class="badge badge-circled">1</span>
			<h3>Build Your Appetite </h3>
			<p>
				Feeling hungry and want to treat yourself? search for a local food and drinks restaurant in your local area
			</p>
		</div>
		<div class="col-md-4 hiw">
			<img width="100px" src="/images/student.png" alt=""><br><br>
			<span class="badge badge-circled">2</span>
			<h3>Opt in to a Restaurant </h3>
			<p>
				Opt in to your desired local food and drinks destination and receive a welcome deal
			</p>
		</div>
		<div class="col-md-4 hiw">
			<img width="100px" src="/images/coupon%20(2).png" alt=""><br><br>
			<span class="badge badge-circled">3</span>
			<h3>Receive your deal  </h3>
			<p>
				Thereon redeem weekly deals by showing a unique code to the business owner every time you visit!
			</p>
		</div>

	</div>
</div>
</section>
<!-- end spacer section -->
	<!-- section: about-->
<section id="about" class="section">
<div class="container">
	<h4>Who We Are</h4>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div>
				<p>
					Take note we are not a food delivery company, instead our goal is to entice you
					to visit new places and to explore new favourites, where ever you may be take
					delight in being able to spend quality time at quality establishments with your
					dearest and your nearest.

				</p>
				<p class="text-center">
					<a class="btn btn-white" href="/about.html">Find out more..</a>
				</p>

			</div>
		</div>

	</div>

</div>
<!-- /.container -->
</section>
<!-- end section: about -->

<!-- section: partner business programme-->
<section id="pbp" class="section">

<!-- Four columns -->
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<hr>
			</div>

			<div class="col-md-5 col-md-offset-1">
				<div style="background: white; padding:1em">
					<h2>Partner Business Programme</h2>
					<p>
						Interested in working with us? Give us a shout whether you are a food & drinks business owner,
						a skilled professional in tech or a potential partner who wants to see this grow. <br>
						{{--Contact us at:
						<strong><a href="mailto:info@planitin.co.ukSubject=Partner%20Business%20Programme" target="_top">info@planitin.co.uk</a></strong>--}}
					</p>
					<Button class="btn btn-white">Contact Us</Button>
				</div>
			</div>
			<div class="col-md-5">
				<br><br>
				<img class="img-responsive" src="/images/bg0.jpg" alt="">

			</div>
			<div class="col-md-10 col-md-offset-1">
				<br>
				<br>
				<hr>
			</div>
		</div>

	</div>



</section>
<!-- end section: services -->
	<!-- Four columns -->


@endsection
@section('before-footer')
	<div class="container-fluid before-footer">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<blockquote class="large">
						<h2>Bringing you exclusive <span>deals </span><br>
							from your favourite <span>food </span>& <span>drink</span><br>
							across London
						</h2>
				</blockquote>
			</div>


		</div>

	</div>

@endsection
@section('script')
	<script src="/js/jquery.flexslider.js"></script>
	 <script>
        // flexslider main

	$('#main-flexslider').flexslider({
		animation: "swing",
		direction: "vertical",
		slideshow: true,
		slideshowSpeed: 3500,
		animationDuration: 1000,
		directionNav: true,
		prevText: '<i class="icon-angle-up icon-2x"></i>',
		nextText: '<i class="icon-angle-down icon-2x active"></i>',
		controlNav: false,
		smootheHeight:true,
		useCSS: false
	});
    </script>

	@endsection

