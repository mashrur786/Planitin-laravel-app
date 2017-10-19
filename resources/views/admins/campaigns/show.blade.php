@extends('admins.dashboard')

@section('styles')
    <style>
        form {
            display: inline-block;
        }
    </style>
@endsection

@section('page-title')
     Campaigns
@endsection

@section('content')

    @include('partials.campaigns.single')

@endsection 