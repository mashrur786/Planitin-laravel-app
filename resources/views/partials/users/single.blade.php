<div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <span class="label label-primary">Memeber since {{ $user->created_at->diffForHumans() }}</span>
                    <h2>{{ $user->name}} </h2>
                    <p style="font-size: large">{{ $user->email }}</p>

                </div>
            </div>
            <div class="panel-body">

                <h3>Subscriptions</h3>

                @if($user->restaurants->count() > 0)
                    <ul class="list-group">
                    @foreach($user->restaurants as $key => $restaurant)
                    <li class="list-group-item">
                        <span>{{ $restaurant->business_name }}</span>
                        <span class="label label-primary pull-right">
                           Subscribed:  {{ Carbon\Carbon::parse($restaurant->users->find($user->id)->pivot->updated_at)->format('M d Y') }}
                        </span>
                    </li>
                    @endforeach
                    </ul>
                @else

                <p>{{ $user->name}} is not subscribe to any restaurant</p>

                @endif


            </div>
            <div class="panel-footer">
                    <a class="btn btn-primary" href="{{ route('admin.users') }}"> Go back</a>

            </div>
        </div>

    </div>
