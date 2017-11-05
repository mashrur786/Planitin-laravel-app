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
              <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                      <a href="users/{{  $user->id }}">
                            <button class="btn btn-sm btn-info">
                                <i class="fa fa-external-link" aria-hidden="true"></i>
                            </button>
                        </a>
                       <a href="users/{{  $user->id }}/edit">
                            <button class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </button>
                        </a>
                  </td>
              </tr>
          @endforeach
    </tbody>
  </table>

@endsection