
<div class="row restaurant-single">
    <div class="col-md-12">
        <div class="cuisine-req">
            <h3 class="inline">
                {{ ucfirst(trans($restaurant->cuisine))  }}
        </h3>
            <span class="requirements">
            @if(!$restaurant->requirements->isEmpty())
                @foreach($restaurant->requirements as $requirement)
                <span class="label label-white">{{ $requirement->name }}</span>
                @endforeach
            @endif
        </span>
        </div>
    </div>
    <div class="col-md-4">
        <img class="img-responsive img-rounded box-shadow" src="/uploads/restaurant_imgs/{{ $restaurant->featured_img or 'default.png' }}" alt=""/>
    </div>
    <div class="col-md-8">
        <h1 class="inline">
            {{ ucwords($restaurant->business_name) }}
        </h1>
        <div class="rateYo inline" data-rateyo-rating="{{ $restaurant->isRated() ? $restaurant->avgRating : 0 }}"></div>
        <div class="tel">
            <span class="ion-ios-telephone"></span>
            <span>{{ $restaurant->business_phone1 }}</span>
        </div>

        <div class="address">
                <span class="ion-ios-location"></span>
                <span>{{ $restaurant->address }}</span>
                <span>{{ $restaurant->street }}</span>
                <span>{{ $restaurant->town }}</span>
                <span>{{ $restaurant->outcode . ' ' . $restaurant->incode }}</span>
        </div>
        <div class="btn-wrapper">
          {{--  @if(!$restaurant->subscriptions->user_id == Auth::id())--}}

                @if(Auth::check() && Auth::user()->isSubscribed($restaurant->id))

                    <a href="{{ route('restaurants.unsubscribe',['id' => $restaurant->id]) }}">
                        <button type="submit" class="btn btn-success">OPT OUT</button>
                    </a>
                @else
                     <a href="{{ route('restaurants.subscribe',['id' => $restaurant->id]) }}">
                        <button type="submit" class="btn btn-success">OPT IN</button>
                     </a>
                @endif
           {{-- @endif--}}
        </div>
        <p class="description">{{ $restaurant->description }}</p>

    </div>
</div>
<div class="row tab">
    <div class="col-md-12">
        <input id="tab1" type="radio" name="tabs" checked>
        <label for="tab1">
            <i class="fa fa-ticket" aria-hidden="true"></i>
            Deals & Offers
        </label>
        <input id="tab2" type="radio" name="tabs">
        <label for="tab2">
            <i class="fa fa-certificate" aria-hidden="true"></i>
            Reward Points
        </label>
        <section id="content1">
             @if($restaurant->campaigns->count() > 0)
            <h3>Deals & Offers</h3>
            <div class="coupon-wrapper">
            @foreach($restaurant->campaigns as $campaign)
                <div class="coupon">
                      <span class="label label-warning">{{ $campaign->expires->format('l j F Y')  }}</span>
                      <a href="#" data-toggle="modal" data-target="#{{ $campaign->id }}">
                         <h4>{{ $campaign->title }}</h4>
                     </a>
                     <!-- Modal -->
                    <div class="modal fade" id="{{$campaign->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title inline" id="exampleModalLabel">{{$campaign->title}}</h5>
                            <span class="label label-warning pull-right">{{ $campaign->expires->format('l j F Y')  }}</span>
                          </div>
                          <div class="modal-body">

                            {!! $campaign->description !!}
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- eof modal --}}
                    <a href="/home" class="btn btn-white pull-right">Get Code </a>
                </div>
            @endforeach
            </div>
        @else
            <h3>Sorry! No deals & offers at this time , please try back later. </h3>
        @endif

        </section>
        <section id="content2">
             {!!  $restaurant->promotion_text !!}
        </section>
    </div>
</div>



