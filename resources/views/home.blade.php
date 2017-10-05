@extends('layouts.app')

@section('style')
    <style>


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

.card .card-heading {
    padding: 0 20px;
    margin: 0;
}

.card .card-heading.simple {
    font-size: 20px;
    font-weight: 300;
    color: #777;
    border-bottom: 1px solid #e5e5e5;
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

.card .card-heading.image .card-heading-header {
    display: inline-block;
    vertical-align: top;
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

.card .card-body {
    padding: 0 20px;
    margin-top: 20px;
}

.card .card-media {
    padding: 0 20px;
    margin: 0 -14px;
}

.card .card-media img {
    max-width: 100%;
    max-height: 100%;
}

.card .card-actions {
    min-height: 30px;
    padding: 0 20px 20px 20px;
    margin: 20px 0 0 0;
}

.card .card-comments {
    padding: 20px;
    margin: 0;
    background-color: #f8f8f8;
}

.card .card-comments .comments-collapse-toggle {
    padding: 0;
    margin: 0 20px 12px 20px;
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

.card-comments .media-heading {
    font-size: 13px;
    font-weight: bold;
}

.card.people {
    position: relative;
    display: inline-block;
    width: 170px;
    height: 300px;
    padding-top: 0;
    margin-left: 20px;
    overflow: hidden;
    vertical-align: top;
}

.card.people:first-child {
    margin-left: 0;
}

.card.people .card-top {
    position: absolute;
    top: 0;
    left: 0;
    display: inline-block;
    width: 170px;
    height: 150px;
    background-color: #ffffff;
}

.card.people .card-top.green {
    background-color: #53a93f;
}

.card.people .card-top.blue {
    background-color: #427fed;
}

.card.people .card-info {
    position: absolute;
    top: 150px;
    display: inline-block;
    width: 100%;
    height: 101px;
    overflow: hidden;
    background: #ffffff;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
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

.card.people .card-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    display: inline-block;
    width: 100%;
    padding: 10px 20px;
    line-height: 29px;
    text-align: center;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
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

.coupon #head {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    min-height: 56px;
}

.coupon #footer {
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}

#title .visible-xs {
    font-size: 12px;
}

.coupon #title img {
    font-size: 30px;
    height: 30px;
    margin-top: 5px;
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

.coupon-img {
    width: 100%;
    margin-bottom: 15px;
    padding: 0;
}

.items {
    margin: 15px 0;
}

.usd, .cents {
    font-size: 20px;
}

.number {
    font-size: 40px;
    font-weight: 700;
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

.disclosure {
    padding-top: 15px;
    font-size: 11px;
    color: #bcbcbc;
    text-align: center;
}

.coupon-code {
    color: #333333;
    font-size: 11px;
}

.exp {
    color: #f34235;
}

.print {
    font-size: 14px;
    float: right;
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
                                        <li>4,820 SqFt</li>

                                        <li style="list-style: none">|</li>

                                        <li>5 Beds</li>

                                        <li style="list-style: none">|</li>

                                        <li>5 Baths</li>
                                    </ul>

                                    <p class="hidden-xs">
                                        {{
                                            $restaurant->description
                                        }}
                                    </p><span class="fnt-smaller fnt-lighter fnt-arial">Courtesy of HS Fox & Roach-Chestnut Hill
                                    Evergreen</span>

                                </div>
                            </div>
                            <hr>
                            @foreach($restaurant->campaigns as $campaign)
                                        <div class="coupon">
                                            <span class="label label-warning">{{ $campaign->expires->format('l j F Y')  }}</span>
                                            <span class="pull-right">
                                                <i class="glyphicon glyphicon-info-sign" aria-hidden="true"></i>
                                            </span>
                                        <h4>{{ $campaign->title }}</h4>
                                            <small>{!!   $campaign->description !!}</small>
                                            <span class="pull-right">code</span>

                                        </div>

                                        @endforeach
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

@endsection
