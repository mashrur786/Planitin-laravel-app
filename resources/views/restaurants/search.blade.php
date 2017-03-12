@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col col-md-offset-2">
                <form action="{{ route('result') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input name="postcode" type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                    </div><!-- /input-group -->
                </form>

            </div><!-- /.col-lg-6 -->
        </div>
    </div>
@endsection
