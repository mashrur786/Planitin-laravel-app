@extends('layouts.app')

@section('content')
    <div class="container res-search-auto">
        <div class="row">
            <div class="col-md-8 col col-md-offset-2">
                <form action="{{ route('restaurants.search') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <select name="res_type" class="selectpicker">
                            <option value="restaurant">Restaurants</option>
                            <option value="takeaway">Takeaways</option>
                            <option value="cafe">Cafés & Bars</option>
                            <option value="dessert">Dessert Parlours</option>
                        </select>
                    <input name="location" type="text" class="form-control" placeholder="Search for restaurants by area or postcode...">
                    <span class="input-group-btn">
                        <button class="btn btn-white btn-primary" type="submit"> Search </button>
                    </span>
                    </div><!-- /input-group -->
                </form>
            </div><!-- /.col-lg-6 -->
        </div>
    </div>
@endsection
@section('script')
    <script>

   /*     $(function(){
            $("#term").autocomplete({
                source: "{{ route("restaurants.autocompleteSearch") }}",
                minLength: 3,
                select: function( event, ui ) {
                    console.log(ui);
                    $(this).after( "<input type='hidden' name='id' value='"+ ui.item.id +"' >" );

                }
            });

        });//end of function*/

    </script>
@endsection
