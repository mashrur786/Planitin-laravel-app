@extends('admins.dashboard')

@section('page-title')
    {{ $user->name }}
@endsection
@section('content')

    @include('partials.users.single')

@endsection