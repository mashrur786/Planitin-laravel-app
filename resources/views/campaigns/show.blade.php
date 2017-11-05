@extends('layouts.app')


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
             @include('partials.campaigns.single');
        </div>
@endsection
