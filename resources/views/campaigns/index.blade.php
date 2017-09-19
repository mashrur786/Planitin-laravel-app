@extends('admins.dashboard')

@section('content')

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Restaurant</th>
                <th>Title</th>
                <th>Description</th>
                <th>Expires</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach($campaigns as $campaign)
                    <td>{{ $campaign->id }}</td>
                    <td>{{ $campaign->restaurant->business_name }}</td>
                    <td>{{ $campaign->title }}</td>
                    <td>{{ $campaign->description }}</td>
                    <td>{{ $campaign->expires->diffForHumans() }}</td>
                @endforeach
            </tr>
         </tbody>
    </table>
@endsection
