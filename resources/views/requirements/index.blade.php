@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1>All Requirements</h1>
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @foreach ( $requirements as $requirement)
                        <tr>
                            <th>{{ $requirement->id }}</th>
                            <td>{{ $requirement->name }}</td>
                            <td>
                                <form method="POST" action="{{ route('requirements.destroy', $requirement->id) }}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="well">
                     <h3>Create New Requirements</h3>
                    <form method="POST" action="{{ route('requirements.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input class="form-control" type="text" name="name">
                        </div>
                        <input class="btn btn-primary" type="submit" value="Create">
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection