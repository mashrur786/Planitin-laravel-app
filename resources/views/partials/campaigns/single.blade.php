<div class="col-md-12">
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

                @if(Auth::guard('admin')->check())
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
                @else
                    <a class="btn btn-primary" href="{{ route('partner.dashboard') }}"> Go back</a>
                @endif

            </div>
        </div>

    </div>