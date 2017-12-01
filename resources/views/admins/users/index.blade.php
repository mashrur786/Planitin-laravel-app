@extends('admins.dashboard')

@section('page-title')
    Users
@endsection
@section('content')
      <table class="table table-striped">
    <thead>
      <tr>
        <th> # </th>
        <th> Name </th>
        <th> Email </th>
        <th> Action </th>
      </tr>
    </thead>

    <tbody>
          @foreach($users as $user)
              <tr class="{{ ($user->isActive()) ? '' : 'bg-danger'  }}">
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                      <a href="users/{{  $user->id }}">
                            <button class="btn btn-sm btn-info">
                                <i class="fa fa-external-link" aria-hidden="true"></i>
                            </button>
                        </a>
                      @if($user->isActive())
                          <form class="inline" action="{{ route('admin.users.deactivate', $user->id ) }}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-sm btn-warning">
                                    <i class="fa fa-ban"></i>
                                </button>
                          </form>
                      @else
                               <form class="inline" action="{{ route('admin.users.activate', $user->id ) }}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-sm btn-warning">
                                    <i class="fa fa-check"></i>
                                </button>
                                </form>
                       @endif

                  </td>
              </tr>
          @endforeach
    </tbody>
  </table>

@endsection