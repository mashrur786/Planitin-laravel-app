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
                <th>Campaign</th>
                <th>Restaurant</th>
                <th>Created</th>
                <th>Expires</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            @foreach($campaigns as $campaign)
                <tr>
                    <td><a href="{{ route('admin.campaigns.show',$campaign->id ) }}">{{ $campaign->title }}</a></td>
                    <td>{{ $campaign->restaurant->business_name }}</td>
                    <td>{{ $campaign->created_at->toDateString() }}</td>
                    <td>{{ $campaign->expires->diffForHumans() }}</td>
                    <td>

                        <a href="{{ route('admin.campaigns.edit', $campaign->id) }}">
                            <button type="submit" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>

                            </button>

                        </a>
                    </td>
                </tr>
            @endforeach

         </tbody>
    </table>
@endsection
