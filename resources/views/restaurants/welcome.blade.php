@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col col-md-offset-2">
                <form action="{{ route('restaurants.search') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input id="term" name="term" type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                    </div><!-- /input-group -->
                </form>

            </div><!-- /.col-lg-6 -->
        </div>
    </div>
@endsection
@section('script')
    <script>

        $(function(){
            $("#term").autocomplete({
                source: "{{ route("restaurants.autocompleteSearch") }}",
                minLength: 3,
                select: function( event, ui ) {
                    console.log(ui);
                    $(this).after( "<input type='hidden' name='id' value='"+ ui.item.id +"' >" );

                }
            });

        });//end of function

    </script>
@endsection
