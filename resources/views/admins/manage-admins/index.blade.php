@extends('admins.dashboard')

@section('page-title')
    Admins
@endsection

@section('content')

    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary pull-right" href="">Create Admin User</a>
    <div class="clearfix"></div>
    <hr>
    <table class="table table-striped">
    <thead>
      <tr>
        <th> # </th>
        <th> Name </th>
        <th> role </th>
        <th> email </th>
        <th> Action </th>
      </tr>
    </thead>
    <tbody>
          @foreach($admins as $admin)
              <tr>
                  <td>{{ $admin->id }}</td>
                  <td>{{ $admin->name }}</td>
                  <td>{{ $admin->role }}</td>
                  <td>{{ $admin->email }}</td>
                  <td>
                      <form method="post" action="{{ route('admin.admins.destroy', $admin->id) }}">
                             {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm btn-danger">
                                <i class="fa  fa-trash-o" aria-hidden="true"></i>
                            </button>
                      </form>
                  </td>
              </tr>
          @endforeach
    </tbody>
  </table>

@endsection