@extends('admins.dashboard')

@section('page-title')
    {{ $restaurant->business_name   }}
@endsection

@section('content')
    @include('partials.restaurants.single')
@endsection