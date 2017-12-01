@extends('layouts.app')
{{-- Stylesheet--}}
{{-- Content--}}
@section('content')
    <div class="container">

        @foreach($restaurants_info as $restaurant_info)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default  panel--styled">
                    <div class="panel-body">
                        <div class="col-md-12 panelTop">
                            <div class="col-md-4">
                                <img class="img-responsive" src="/uploads/restaurant_imgs/{{ $restaurant->featured_img or 'default.png' }}" alt=""/>
                            </div>
                            <div class="col-md-8">
                                <small>{{ ucfirst(trans($restaurant_info->cuisine))  }}</small>
                                <h2>{{ $restaurant_info->business_name }}</h2>
                                <p>{{ $restaurant_info->description }}</p>
                                <address>
                                    <strong>{{ $restaurant_info->address }}</strong><br>
                                    {{ $restaurant_info->street }}<br>
                                    {{ $restaurant_info->town }}<br>
                                    {{ $restaurant_info->postcode }}<br>
                                </address>
                            </div>
                        </div>

                        <div class="col-md-12 panelBottom">
                            <div class="col-md-4 text-center">

                                <label class="switch">

                                    <input type="checkbox">
                                    <div class="slider round"></div>
                                </label>
                            </div>
                            <div class="col-md-4 text-left">
                                <span class="tel">{{ $restaurant_info->business_phone1 }}</span>
                            </div>
                            <div class="col-md-4">
                                <div id="stars-existing" class="starrr" data-rating='4'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
{{-- Script--}}
@section('script')
    <script>

    </script>
@endsection