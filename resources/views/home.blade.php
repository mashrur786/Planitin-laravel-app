@extends('layouts.app')

@section('style')
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card hovercard">
                <div class="cardheader">
                </div>
                <div class="avatar">
                    <img alt="" src="http://wfarm2.dataknet.com/static/resources/icons/set112/1df88523.png">
                </div>
                <div class="info">
                    <div class="title">
                        <a target="_blank" href="http://scripteden.com/">
                            {{ Auth::user()->name }}
                        </a>
                    </div>
                    <hr>
                    <div class="desc">
                        {{ Auth::user()->email }}
                    </div>
                    <hr>
                </div>
                <div class="bottom">

                    <a href="{{ route('home.user.edit', ['user_id' => Auth::user()->id ]) }}" class="btn btn-primary">My Account</a>
                </div>
            </div>

        </div>
        <div class="col-md-9">

            {{-- eof restaurant card --}}

            {{-- X--}}
            <div class="container-fluid">
                <div class="container-pad" id="property-listings">

                    <div class="row">
                  <div class="col-md-12">
                    <h1 style="margin-top: 0">Parks & Deals</h1>
                    <p>
                        Get your latest parks and deals from your favourite restaurant
                    </p>
                      <br>
                  </div>
                </div>

                <div class="row">
                    @foreach(Auth::user()->restaurants as $restaurant)
                    <div class="col-sm-12">
                        <!-- Begin Listing: 609 W GRAVERS LN-->
                        <div class="brdr bgc-fff pad-10 btm-mrg-20 property-listing">
                            <div class="media">
                                <a class="pull-left" href="#" target="_parent">
                                    <img class="img-responsive" src="/uploads/restaurant_imgs/{{ $restaurant->featured_img or 'default.png' }}" alt=""/>
                                    <div class="clearfix visible-sm"></div>
                                </a>
                                    <div class="media-body fnt-smaller">
                                    <a href="#" target="_parent"></a>

                                    <h4 class="media-heading">
                                        <a class="res-name" href="{{ route('restaurants.show', [$restaurant->id]) }}" target="_parent">{{ $restaurant->business_name }}
                                          <small class="label label-primary">{{ $restaurant->cuisine }}</small>
                                        </a>
                                    </h4>
                                    {{-- rating --}}
                                    <div
                                            id="{{$restaurant->id}}"
                                            data-restaurant="{{ $restaurant->business_name }}"
                                            class="rateYo" data-rateyo-rating="{{ $restaurant->isRated() ? $restaurant->avgRating : 0 }}"></div>
                                    {{-- /rating--}}

                                    <ul class="list-inline mrg-0 btm-mrg-10 clr-535353">
                                        <li>{{ $restaurant->address }}</li>

                                        <li style="list-style: none">|</li>

                                        <li>{{ $restaurant->street }}</li>

                                        <li style="list-style: none">|</li>

                                        <li>{{ $restaurant->outcode }}  {{ $restaurant->incode }}</li>
                                    </ul>

                                    <p class="tel">
                                        {{ $restaurant->business_phone1 }}
                                    </p>

                                </div>
                                <div data-value="{{ $restaurant->users()
                                                                ->where('restaurant_id', $restaurant->id)
                                                                ->where('user_id', Auth::user()->id)
                                                                ->first()->pivot->points  }}"
                                     data-capstone="{{ $restaurant->capstone }}"
                                     class="circle-progress">
                                    {{--<div data-value="{{ $restaurant->users()->where('restaurant_id', $restaurant->id)->first()->pivot->points  }}" class="circle-progress">--}}

                                     <strong></strong>
                                    <br>
                                    <br>
                                    <a href="#" data-toggle="modal"  data-target="#res{{$restaurant->id}}">Rewards Points</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="res{{$restaurant->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title inline" id="exampleModalLabel"> Rewards Points</h5>
                                          </div>
                                          <div class="modal-body">
                                            <h3> You've collected
                                                <span>
                                                    {{ $restaurant->users()
                                                                ->where('restaurant_id', $restaurant->id)
                                                                ->where('user_id', Auth::user()->id)
                                                                ->first()->pivot->points  }}
                                                </span>

                                                Points out of
                                                <span>
                                                    {{ $restaurant->capstone }}
                                                </span>
                                            </h3>
                                              <hr class="dotted">
                                            {!! $restaurant->promotion_text !!}
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    {{-- eof modal --}}
                                 </div>

                            </div>
                            <hr class="dotted">
                            <p>

                              {{ $restaurant->description }}

                            </p>

                            <hr class="dotted">
                            <div class="coupon-wrapper">

                            @foreach($restaurant->campaigns as $campaign)
                                <?php
                                        $coupon_status = '';

                                        if(Auth::user()->hasCode($campaign->id)){

                                            $coupon_status = Auth::user()->campaigns()->findOrFail($campaign->id)->pivot->redeem ;

                                            if(!empty($coupon_status) && $coupon_status == 1){

                                                $coupon_status = 'redeemed';

                                            }elseif ($campaign->expires <=  \Carbon\Carbon::now()) {

                                                 $coupon_status = 'expired';

                                            } else{

                                                 $coupon_status = '';
                                            }
                                        }

                                ?>


                                <div class="coupon {{ $coupon_status }}">
                                    <span class="label label-warning">{{ $campaign->expires->format('l j F Y')  }}</span>
                                    <span class="pull-right">
                                        <i class="glyphicon glyphicon-info-sign" aria-hidden="true"></i>
                                    </span>
                                     <a href="{{ route('home.campaigns.show', $campaign->id) }}">
                                         <h4>{{ $campaign->title }}</h4>
                                     </a>
                                    <button data-toggle="modal" data-target="#coupon{{$campaign->id}}" class="btn btn-primary btn-code">Get Code</button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" data-id="{{$campaign->id}}" id="coupon{{$campaign->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h3 class="modal-title inline" id="exampleModalLabel">{{ $campaign->title }}</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        {!! $campaign->description !!}
                                          <div class="well code form-control text-center"></div>
                                      </div>
                                      <div class="modal-footer">
                                        <h5 class="label label-default pull-left">

                                            {{ $campaign->expires->format('l j F Y')  }}
                                        </h5>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>{{-- eof modal --}}
                             @endforeach
                            </div>{{-- eof coupon wrapper --}}
                        </div><!-- End Listing-->
                    </div>
                    @endforeach
                </div><!-- End row -->
                </div><!-- End container -->
            </div>
            {{-- X --}}

        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript" src="/js/circle-progress.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        /* ratings */
        $(function(){

            $('.rateYo').each(function(){


                var $rateYo = $(this).rateYo({ratedFill: "#008dc9"});

                /* set the option `onChange` */
                $rateYo.rateYo("option", "onSet", function () {

                /* get the rated fill at the current point of time */
                var rating = $rateYo.rateYo("option", "rating");
                var restaurant_id = $(this).attr('id');
                var restaurant_name = $(this).data('restaurant');

                var CSRF_TOKEN =  '{{ \Illuminate\Support\Facades\Session::token() }}';

                $.ajax({
                    url: '{{ route('restaurants.rate') }}',
                    method: 'POST',
                    data: { _token: CSRF_TOKEN, 'restaurant_id' : restaurant_id, 'rating' : rating},
                    success: function (data) {

                        swal("Thank You!" , "You rated " + restaurant_name + " " + data.rating , "success");

                    }
                });//eof ajax
              });

            });

        });


        /* rewards points */
        $('.circle-progress').each(function () {
            var value = $(this).data('value');
            var capstone = $(this).data('capstone');
            var circleValue;
            if(value > 0 && capstone > 0) {
                circleValue = value/capstone;
            } else {
                 circleValue = 0;
            }
             $(this).circleProgress({
                value: circleValue,
                fill: {gradient: [['#0681c4', .5], ['#4ac5f8', .5]], gradientAngle: Math.PI / 4}
            }).on('circle-animation-progress', function(event, progress, stepValue) {
                $(this).find('strong').text(stepValue.toFixed(3).substr(3));
            });
        });


        $('.btn-code').click(function(){

            var container = $(this).parent('.coupon').next('.modal').find('.well.code');
            var campaign_id = $(this).parent('.coupon').next('.modal').data('id');
            var CSRF_TOKEN =  '{{ \Illuminate\Support\Facades\Session::token() }}';

                $.ajax({
                    url: '{{ route('get.code') }}',
                    method: 'POST',
                    data: { _token: CSRF_TOKEN, 'campaign_id' : campaign_id },
                    success: function (data) {
                        console.log(data);
                        container.html(data);
                    }
                });
            //console.log();

        })
    </script>
@endsection
