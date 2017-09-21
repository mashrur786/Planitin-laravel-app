@extends('admins.dashboard')
@section('page-title')
    Campaigns
@endsection
@section('content')
    <a href="{{ action('CampaignController@create') }}">
        <button class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Create Campaign
        </button>
    </a>

    <div class="clearfix"></div>
    <hr>
    <table class="table table-striped">
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

            @foreach($campaigns as $campaign)
                <tr>
                    <td>{{ $campaign->id }}</td>
                    <td>{{ $campaign->restaurant->business_name }}</td>
                    <td>{{ $campaign->title }}</td>
                    <td>{{ strip_tags($campaign->description) }}</td>
                    <td>{{ $campaign->expires->diffForHumans() }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger">
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
            @endforeach

         </tbody>
    </table>
@endsection
