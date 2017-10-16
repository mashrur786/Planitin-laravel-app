@extends('layouts.app')

@section('style')
    <style>

.inline {
    display: inline;
}
.card {
    padding-top: 20px;
    margin: 0 0 20px 0;
    background-color: rgba(214, 224, 226, 0.2);
    border-top-width: 0;
    border-bottom-width: 2px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-box-shadow: 0px 0px 18px -6px rgba(0,0,0,1);
    -moz-box-shadow: 0px 0px 18px -6px rgba(0,0,0,1);
    box-shadow: 0px 0px 18px -6px rgba(0,0,0,1);
}

.card .card-heading.image img {
    display: inline-block;
    width: 46px;
    height: 46px;
    margin-right: 15px;
    vertical-align: top;
    border: 0;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
}


.card .card-heading.image .card-heading-header h3 {
    margin: 0;
    font-size: 14px;
    line-height: 16px;
    color: #262626;
}

.card .card-heading.image .card-heading-header span {
    font-size: 12px;
    color: #999999;
}


.card .card-media img {
    max-width: 100%;
    max-height: 100%;
}

.card .card-comments .comments-collapse-toggle a,
.card .card-comments .comments-collapse-toggle span {
    padding-right: 5px;
    overflow: hidden;
    font-size: 12px;
    color: #999;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.card.people .card-info .title {
    display: block;
    margin: 8px 14px 0 14px;
    overflow: hidden;
    font-size: 16px;
    font-weight: bold;
    line-height: 18px;
    color: #404040;
}

.card.people .card-info .desc {
    display: block;
    margin: 8px 14px 0 14px;
    overflow: hidden;
    font-size: 12px;
    line-height: 16px;
    color: #737373;
    text-overflow: ellipsis;
}

.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: rgba(214, 224, 226, 0.2);
}

.card.hovercard .cardheader {

    background: -webkit-linear-gradient(135deg, rgba(23, 164, 79, 0.5) 0%, rgba(51, 122, 183, 0.7) 100%);

    background-size: cover;
    height: 135px;
}

.card.hovercard .avatar {
    position: relative;
    top: -50px;
    margin-bottom: -50px;
}

.card.hovercard .avatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255,255,255,0.5);
}

.card.hovercard .info {
    padding: 4px 8px 10px;
}

.card.hovercard .info .title {
    margin-bottom: 4px;
    font-size: 24px;
    line-height: 1;
    color: #262626;
    vertical-align: middle;
}

.card.hovercard .info .desc {
    overflow: hidden;
    font-size: 12px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}

.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}

/* Card Restaurants */
/**** LAYOUT ****/
.list-inline>li {
    padding: 0 10px 0 0;
}
.container-pad {
    padding: 30px 15px;
}


/**** MODULE ****/
.bgc-fff {
    background-color: #fff!important;
}
.box-shad {
    -webkit-box-shadow: 1px 1px 0 rgba(0,0,0,.2);
    box-shadow: 1px 1px 0 rgba(0,0,0,.2);
        border-top-width: 0;
    border-bottom-width: 2px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-box-shadow: 0px 0px 18px -6px rgba(0,0,0,1);
    -moz-box-shadow: 0px 0px 18px -6px rgba(0,0,0,1);
    box-shadow: 0px 0px 18px -6px rgba(0,0,0,1);
}
.brdr {
    border: 1px solid #ededed;

}

/* Font changes */
.fnt-smaller {
    font-size: .9em;
}
.fnt-lighter {
    color: #bbb;
}

/* Padding - Margins */
.pad-10 {
    padding: 10px!important;
}
.mrg-0 {
    margin: 0!important;
}
.btm-mrg-10 {
    margin-bottom: 10px!important;
}
.btm-mrg-20 {
    margin-bottom: 20px!important;
}

/* Color  */
.clr-535353 {
    color: #535353;
}

/* coupon */
.coupon-wrapper {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
}

.coupon {
    border: 3px dashed #bcbcbc;
    border-radius: 10px;
    font-family: "HelveticaNeue-Light", "Helvetica Neue Light",
    "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
    font-weight: 300;
    display: inline-block;
    padding: 10px;
    margin: 10px;
    width: 300px;

}

.coupon.redeemed, .coupon.expired {
    background: #d6d6d6;
    color: #7d7d7d;
    position: relative;

}

.coupon.redeemed::after{
    content: 'Redeemed';
}

.coupon.expired::after {
    content: 'Expired';
}
.coupon.redeemed::after, .coupon.expired::after{

    position: absolute;
    z-index: 111;
    top:0;
    left: 0;
    width: 100%;
    height: 100%;
    text-align: center;
    padding-top: 33px;
    font-size: 2em;
    color: #eceaea;
    background: rgba(119, 119, 119, 0.34);
    border-radius: 6px;
}

.coupon.redeemed button, .coupon.expired button {
    visibility: hidden;
}

.coupon.redeemed .label.label-warning , .coupon.expired .label.label-warning {
    background-color: gray;
    color: #a8a8a8;;
}



.well.code {
    height:60px;
    max-width: 400px;
    margin: 20px auto;
    font-size: 2.2em;
    padding: 10px;
    font-weight:300;
}
@media screen and (max-width: 500px) {
    .coupon #title img {
        height: 15px;
    }
}

.coupon #title span {
    float: right;
    margin-top: 5px;
    font-weight: 700;
    text-transform: uppercase;
}

sup {
    top: -15px;
}

#business-info ul {
    margin: 0;
    padding: 0;
    list-style-type: none;
    text-align: center;
}

#business-info ul li {
    display: inline;
    text-align: center;
}

#business-info ul li span {
    text-decoration: none;
    padding: .2em 1em;
}

#business-info ul li span i {
    padding-right: 5px;
}

/**** MEDIA QUERIES ****/
@media only screen and (max-width: 991px) {
    #property-listings .property-listing {
        padding: 5px!important;
    }
    #property-listings .property-listing a {
        margin: 0;
    }
    #property-listings .property-listing .media-body {
        padding: 10px;
    }
}

@media only screen and (min-width: 992px) {
    #property-listings .property-listing img {
        max-width: 180px;
    }
}

    </style>

@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card hovercard">
                <div class="cardheader">
                </div>
                <div class="avatar">
                    <img alt="" src="http://lorempixel.com/100/100/people/7/">
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
                    <button class="btn btn-warning">Edit</button>
                </div>
            </div>

        </div>
        <div class="col-md-9">

            {{-- eof restaurant card --}}

            {{-- X--}}
            <div class="container-fluid" style="background-color:#e8e8e8">
                <div class="container-pad" id="property-listings">

                    <div class="row">
                  <div class="col-md-12">
                    <h1>Parks & Deals</h1>
                    <p>
                        Get your latest parks and deals from your favourite restaurant
                    </p>
                  </div>
                </div>

                    <div class="row">
                    @foreach(Auth::user()->restaurants as $restaurant)
                    <div class="col-sm-12">
                        <!-- Begin Listing: 609 W GRAVERS LN-->
                        <div class="brdr bgc-fff pad-10 box-shad btm-mrg-20 property-listing">
                            <div class="media">
                                <a class="pull-left" href="#" target="_parent">
                                <img alt="image" class="img-responsive" src="https://static.pexels.com/photos/2232/vegetables-italian-pizza-restaurant.jpg"></a>

                                <div class="clearfix visible-sm"></div>

                                <div class="media-body fnt-smaller">
                                    <a href="#" target="_parent"></a>

                                    <h4 class="media-heading">
                                      <a href="#" target="_parent">{{ $restaurant->business_name }}<small class="label label-primary pull-right">{{ $restaurant->cuisine }}</small></a></h4>


                                    <ul class="list-inline mrg-0 btm-mrg-10 clr-535353">
                                        <li>{{ $restaurant->address }}</li>

                                        <li style="list-style: none">|</li>

                                        <li>{{ $restaurant->street }}</li>

                                        <li style="list-style: none">|</li>

                                        <li>{{ $restaurant->outcode }}  {{ $restaurant->incode }}</li>
                                    </ul>

                                    <p class="hidden-xs">
                                        {{ $restaurant->business_phone1 }}
                                    </p>
                                    <span class="fnt-smaller fnt-lighter fnt-arial">
                                          {{ $restaurant->description }}
                                    </span>

                                </div>
                            </div>
                            <hr>
                            <div class="coupon-wrapper">
                            @foreach($restaurant->campaigns as $campaign)
                                        <?php
                                            $coupon_status = '';
                                        ?>
                                        @if(Auth::user()->campaigns()->findOrFail($campaign->id)->pivot->redeem == 1)
                                            <?php $coupon_status = 'redeemed' ?>
                                        @elseif($campaign->expires <=  \Carbon\Carbon::now())
                                            <?php $coupon_status = 'expired' ?>
                                        @endif
                                        <div class="coupon {{ $coupon_status }}">
                                            <span class="label label-warning">{{ $campaign->expires->format('l j F Y')  }}</span>
                                            <span class="pull-right">
                                                <i class="glyphicon glyphicon-info-sign" aria-hidden="true"></i>
                                            </span>
                                            <h4>{{ $campaign->title }}</h4>
                                            <button data-toggle="modal" data-target="#{{$campaign->id}}" class="pull-right btn btn-default btn-code">Get Code</button>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="{{ $campaign->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <script type="text/javascript">
        $('.btn-code').click(function(){

            var container = $(this).parent('.coupon').next('.modal').find('.well.code');
            var campaign_id = $(this).parent('.coupon').next('.modal').attr('id');
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
