@extends('admins.dashboard')

@section('page-title')
    {{ $restaurant->business_name   }}
@endsection

@section('content')
    @include('partials.restaurants.single')
      <form method="POST" action="{{ route('admin.restaurants.destroy', $restaurant->id) }}">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
         <button type="submit" class="btn btn-sm btn-danger pull-right">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
             Delete
        </button>

      </form>
    <br>
    <hr>
    <br><br><br>

@endsection