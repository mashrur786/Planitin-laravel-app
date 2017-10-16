@extends('partners.dashboard')
@section('style')
    <style>
        .inline {
    display: inline;
}
.card {
    padding-top: 20px;
    margin: 0 0 20px 0;
    background-color: rgba(214, 224, 226, 0.2);
    border-top-width: 0;
    border-bottom-width: 2px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-box-shadow: 0px 0px 18px -6px rgba(0,0,0,1);
    -moz-box-shadow: 0px 0px 18px -6px rgba(0,0,0,1);
    box-shadow: 0px 0px 18px -6px rgba(0,0,0,1);
}

.card .card-heading.image img {
    display: inline-block;
    width: 46px;
    height: 46px;
    margin-right: 15px;
    vertical-align: top;
    border: 0;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
}


.card .card-heading.image .card-heading-header h3 {
    margin: 0;
    font-size: 14px;
    line-height: 16px;
    color: #262626;
}

.card .card-heading.image .card-heading-header span {
    font-size: 12px;
    color: #999999;
}


.card .card-media img {
    max-width: 100%;
    max-height: 100%;
}

.card .card-comments .comments-collapse-toggle a,
.card .card-comments .comments-collapse-toggle span {
    padding-right: 5px;
    overflow: hidden;
    font-size: 12px;
    color: #999;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.card.people .card-info .title {
    display: block;
    margin: 8px 14px 0 14px;
    overflow: hidden;
    font-size: 16px;
    font-weight: bold;
    line-height: 18px;
    color: #404040;
}

.card.people .card-info .desc {
    display: block;
    margin: 8px 14px 0 14px;
    overflow: hidden;
    font-size: 12px;
    line-height: 16px;
    color: #737373;
    text-overflow: ellipsis;
}

.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: rgba(214, 224, 226, 0.2);
}

.card.hovercard .cardheader {

    background: -webkit-linear-gradient(135deg, rgba(23, 164, 79, 0.5) 0%, rgba(51, 122, 183, 0.7) 100%);

    background-size: cover;
    height: 135px;
}

.card.hovercard .avatar {
    position: relative;
    top: -50px;
    margin-bottom: -50px;
}

.card.hovercard .avatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255,255,255,0.5);
}

.card.hovercard .info {
    padding: 4px 8px 10px;
}

.card.hovercard .info .title {
    margin-bottom: 4px;
    font-size: 24px;
    line-height: 1;
    color: #262626;
    vertical-align: middle;
}

.card.hovercard .info .desc {
    overflow: hidden;
    font-size: 12px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}

.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}

/* second style card*/

    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card hovercard">
                <div class="cardheader">
                </div>
                <div class="avatar">
                    <img alt="" src="https://t4.ftcdn.net/jpg/01/08/67/67/240_F_108676768_rBoEzb89GaDyzbNWyvI7rInWRxEacyqJ.jpg">
                </div>
                <div class="info">
                    <div class="title">
                        <a target="_blank" href="http://scripteden.com/">
                        </a>
                    </div>
                    <h3>
                    {{ ucwords(Auth::user()->business->business_name)}}
                    </h3>
                    <div class="desc">
                        <hr>
                        <h4><a href="">Account</a></h4>
                        <hr>
                         <h4><a href="">Campaigns</a></h4>
                    </div>

                    <hr>
                </div>
                <div class="bottom">

                </div>
            </div>

        </div>
        <div class="col-md-9">

            {{-- X--}}
            <div class="container-fluid">
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
                                    <button class="btn btn-default" type="submit"> Redeem </button>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            @foreach(Auth::user()->business->campaigns as $campaign)
                                <td>

                                </td>
                                <td>
                                    <h4>{{ $campaign->title }}</h4>
                                </td>
                                <td>
                                    {{ $campaign->expires }}
                                </td>
                                <td>

                                    <a href="" class="btn btn-small btn-primary">
                                        View
                                    </a>
                                </td>
                            @endforeach
                            </tr>
                        </tbody>

                    </table>
                    <br>
                    <div class="panel-footer">

                    </div>
                </div>{{-- /panel --}}
                {{-- /campaigns --}}



            </div>{{-- /container-fluid --}}

            {{-- X --}}

        </div>
    </div>
</div>
@endsection