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

    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2 style="display: inline-block">{{ ucwords($campaign->title) }}</h2>
                    <h4>
                        <span class="label label-primary">{{ $campaign->expires->diffForHumans() }}</span>
                    </h4>
                </div>
            </div>
            <div class="panel-body">

                    <p style="font-size: large">{{ $campaign->restaurant->business_name }}</p>
                <hr>
                    <div>
                        {!!   $campaign->description !!}
                    </div>

            </div>
            <div class="panel-footer">
                 <a href="{{ route('admin.campaigns.edit', $campaign->id) }}">
                    <button type="submit" class="btn btn-sm btn-warning">
                        <i class="fa fa-edit"></i>
                        Edit
                    </button>

                </a>

                <form method="POST" action="{{ route('admin.campaigns.destroy', $campaign->id) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                     <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fa fa-times"></i>
                         Delete
                    </button>
                </form>
            </div>
        </div>

    </div>



@endsection 