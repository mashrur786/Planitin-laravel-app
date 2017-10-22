<div class="panel panel-default  panel--styled">
    <div class="panel-body">
        <div class="col-md-12 panelTop">
            <div class="col-md-4">
                <img class="img-responsive" src="/uploads/restaurant_imgs/{{ $restaurant->featured_img or 'default.png' }}" alt=""/>
            </div>
            <div class="col-md-8">
                {{--@if(!$restaurant->subscriptions->user_id == Auth::id())--}}

                    @if(Auth::check() && Auth::user()->isSubscribed($restaurant))
                    <a href="{{ route('restaurants.unsubscribe',['id' => $restaurant->id]) }}">
                        <button type="submit" class="btn btn-success pull-right">OPT OUT</button>
                     </a>
                    @else
                     <a href="{{ route('restaurants.subscribe',['id' => $restaurant->id]) }}">
                        <button type="submit" class="btn btn-success pull-right">OPT IN</button>
                     </a>
                    @endif


                <div class="label label-primary">{{ ucfirst(trans($restaurant->cuisine))  }}</div>
                <h1>{{ ucwords($restaurant->business_name) }}</h1>
                <p>
                    @if(!$restaurant->requirements->isEmpty())
                        @foreach($restaurant->requirements as $requirement)
                        <span style="margin-right: 5px" class="label label-success">{{ $requirement->name }}</span>
                        @endforeach
                    @endif
                </p>
                <p>{{ $restaurant->description }}</p>
                <p><span class="tel">{{ $restaurant->business_phone1 }}</span></p>
                <address>
                    <strong>{{ $restaurant->address }}</strong><br>
                    {{ $restaurant->street }}<br>
                    {{ $restaurant->town }}<br>
                    {{ $restaurant->outcode . ' ' . $restaurant->incode }}<br>
                </address>

            </div>
            <hr>
            <div class="col-md-12">
                <h3>Deals & Offers</h3>
                <ul class="list-group">
                @foreach($restaurant->campaigns as $campaign)
                    <li class="list-group-item">
                        <span class="label label-primary">
                                {{ $campaign->expires->diffForHumans() }}
                        </span>
                        <h4>
                            {{ $campaign->title }}
                        </h4>
                        <div>
                            {!!  $campaign->description !!}
                        </div>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-12 panelBottom">

        </div>
    </div>
</div>