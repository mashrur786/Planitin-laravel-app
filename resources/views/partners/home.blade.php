@extends('partners.dashboard')
@section('content')
 <div class="card" style="padding-bottom: 40px">
   <div class="row">
       <div class="col-md-12" style="padding: 5px">
           <h3 style="text-align: center; margin-top: 15px;">Redeem Promotional Code </h3>
       </div>
   </div>{{-- /row --}}
   <div class="row">
       <div class="col-md-8 col-md-offset-2">
           <form action="{{ action('PromotionController@redeem') }}">
               {{ csrf_field() }}
            <div class="input-group">
                <input required name="code" type="text" class="form-control" placeholder="Promotion Code">
                <span class="input-group-btn">
                <button class="btn btn-primary" type="submit"> Redeem </button>
                </span>
            </div><!-- /input-group -->
           </form>
       </div>{{-- /col-md-8 --}}
   </div>{{-- /row--}}
</div>{{-- /card--}}

{{-- campaigns --}}

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Campaigns</h3>
  </div>
  <div class="panel-body">
        All of your active campaings
  </div>
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Title</th>
                <th>Date</th>
                <th> Redeemed </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach(Auth::user()->business->campaigns as $campaign)
                 <tr>
                    <td>

                    </td>
                    <td>
                        <h4>{{ $campaign->title }}</h4>
                    </td>
                    <td>
                        {{ $campaign->expires }}
                    </td>
                    <td>
                        {{ \App\Http\Controllers\CampaignController::getRedeemCount($campaign->id) }}

                    </td>
                    <td>
                        <a href="{{ route('partner.campaigns.show', $campaign->id) }}" class="btn btn-small btn-primary">
                            View
                        </a>
                    </td>
                 </tr>
            @endforeach
        </tbody>

    </table>
    <br>
    <div class="panel-footer">

    </div>
</div>{{-- /panel --}}
{{-- /campaigns --}}


@endsection