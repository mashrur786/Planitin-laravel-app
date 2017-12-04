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
            <div class="col-md-8 col col-md-offset-2">
                <form action="{{ route('restaurants.search') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <select name="res_type" class="selectpicker">
                            <option value="restaurant">Restaurants</option>
                            <option value="takeaway">Takeaways</option>
                            <option value="cafe">Cafés & Bars</option>
                            <option value="dessert">Dessert Parlours</option>
                        </select>
                    <input name="location" type="text" class="form-control" placeholder="Search for restaurants by area or postcode...">
                    <span class="input-group-btn">
                        <button class="btn btn-white btn-primary" type="submit"> Search </button>
                    </span>
                    </div><!-- /input-group -->
                </form>
            </div><!-- /.col-lg-6 -->
        </div>
    </div>
    </div>
@endsection

