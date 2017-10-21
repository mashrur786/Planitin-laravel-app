@extends('admins.dashboard')

@section('page-title')
    Restaurants
@endsection

@section('content')
    <div class="col-md-12">
        <a class="btn btn-primary pull-right" href="{{ route('admin.restaurants.create') }}">Add Restaurant</a>
    </div>
    <hr>

    <div class="col-md-12">
        <hr>
        <table class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                <th>Tel</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($restaurants as $restaurant)
                    <tr>
                        <td></td>
                        <td>
                            <a href="/admin/restaurants/{{ $restaurant->id }}">
                                {{ $restaurant->business_name }}
                            </a>

                        </td>
                        <td> {{ $restaurant->email }} </td>
                        <td> {{ $restaurant->business_phone1 }} </td>
                        <td>
                             <a href="restaurants/{{  $restaurant->id }}/edit">
                            <button class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection