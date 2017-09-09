@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default  panel--styled">
                    <div class="panel-body">
                        <div class="col-md-12 panelTop">
                            <div class="col-md-4">
                                <img class="img-responsive" src="http://placehold.it/350x350" alt=""/>
                            </div>
                            <div class="col-md-8">
                                <small>{{ ucfirst(trans($restaurant->cuisine))  }}</small>
                                <h2>{{ $restaurant->business_name }}</h2>
                                <p>{{ $restaurant->description }}</p>
                                <address>
                                    <strong>{{ $restaurant->address }}</strong><br>
                                    {{ $restaurant->street }}<br>
                                    {{ $restaurant->town }}<br>
                                    {{ $restaurant->postcode }}<br>
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
                                <span class="tel">{{ $restaurant->business_phone1 }}</span>
                            </div>
                            <div class="col-md-4">
                                <div id="stars-existing" class="starrr" data-rating='4'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection