@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 filters">

                <a href="" class="btn btn-info btn-block btn-compose-email">Filter Results</a>
                <br/>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Filter by Name</h3>
                          <div class="panel-body">
                              <form>
                                  <input id="res-name" name="resName" type="text" class="form-control">
                              </form>
                          </div>

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cuisine</h3>
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                    </div>
                    <div class="panel-body">
                        @foreach ($cuisines as $cuisine)
                            <div class="checkbox">
                                <label><input data-filter-name="cuisine" class="filter" type="checkbox" value="{{ ucfirst(trans($cuisine->cuisine))  }}"> {{ ucfirst(trans($cuisine->cuisine))  }}</label>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Restaurants Types</h3>
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                    </div>
                    <div class="panel-body">

                        @foreach ($types as $type)

                            <div class="checkbox">
                                <label><input data-filter-name="type" class="filter" type="checkbox" value="{{ ucfirst(trans($type->type))  }}"> {{ ucfirst(trans($type->type))  }}</label>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
            <div class="col-md-8 restaurant-item">
                @if(!$data->isEmpty())
                    @foreach ($data as $restaurant)

                    <div class="panel panel-default  panel--styled">
                        <div class="panel-body">
                            <div class="col-md-12 panelTop">
                                <div class="col-md-4">
                                    <img class="img-responsive" src="http://placehold.it/350x350" alt=""/>
                                </div>
                                <div class="col-md-8">
                                    <small>{{ ucfirst(trans($restaurant->cuisine))  }}</small>
                                    <h4><a href="/restaurants/{{ $restaurant->id }}">{{ $restaurant->business_name }}</a></h4>
                                    <label for="">Address</label>
                                    <p>{{ $restaurant->outcode . ' ' . $restaurant->incode }}</p>
                                    <p>{{ $restaurant->description }}</p>
                                </div>
                            </div>

                            <div class="col-md-12 panelBottom">
                                <div class="col-md-4 text-center">
                                    <label class="switch">
                                        <input type="checkbox">
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-4 text-left">
                                    <span class="tel">{{ $restaurant->business_phone1 }}</span>
                                </div>
                                <div class="col-md-4">
                                    <div id="stars-existing" class="starrr" data-rating='4'></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                @else

                <div class="alert alert-danger">
                    <strong>Oosp!!</strong> We didn't find any restuarants, please try again !!
                </div>
                    <a href="{{ route('welcome') }}">
                        <button type="button" class="btn btn-info btn-lg"><< Back</button>
                    </a>


                @endif

            </div>
        </div>
    </div>
    <script>
        var token = '{{ \Illuminate\Support\Facades\Session::token() }}';
        var url = '{{ route('restaurants.sort') }}';
    </script>
@endsection
{{-- Script--}}
@section('script')
    <script>
        //function for restaurent name auto search

        $(function(){

            $("#res-name").autocomplete({

                source: "{{ URL::route('restaurants.autocompleteSearch') }}",
                minLength: 3,
                select: function( event, ui ) {

                    //$(this).after( "<input type='hidden' name='id' value='"+ ui.item.id +"' >" );

                    var id = ui.item.id ;

                    $.ajax({

                        method:'POST',
                        url: '{{ route('restaurants.sortById') }}',
                        data: { 'id' : id , _token: token },
                        //success
                        success: function(data) {

                            console.log(data);
                            $(".restaurant-item").empty();

                                var   output = "<div class='panel panel-default  panel--styled'>"

                                    + "<div class='panel-body'>"
                                    + "<div class='col-md-12 panelTop'>"
                                    + "<div class='col-md-4'>"
                                    + "<img class='img-responsive' src='http://placehold.it/350x350' alt=''/>"
                                    + "</div>"
                                    + "<div class='col-md-8'>"
                                    + "<small>" + data.cuisine + "</small>"
                                    + "<h4>" + data.business_name + "</h4>"
                                    + "<p>" +  data.description + "</p>"
                                    + "</div>"
                                    + "</div>"

                                    + "<div class='col-md-12 panelBottom'>"
                                    + "<div class='col-md-4 text-center'>"

                                    + "<label class='switch'>"

                                    + "<input type='checkbox'>"
                                    + "<div class='slider round'></div>"
                                    + "</label>"
                                    + "</div>"
                                    + "<div class='col-md-4 text-left'>"
                                    + "<span class='tel'>" + data.business_phone1 + "</span>"
                                    + "</div>"
                                    + "<div class='col-md-4'>"
                                    + "<div id='stars-existing' class='starrr' data-rating='4'></div>"
                                    + "</div>"
                                    + "</div>"
                                    + "</div>"
                                    + "</div>";
                                    $(".restaurant-item").append(output);


                        },
                        //error
                        error : function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                            console.log('inside error');
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });

                }

            });

        });//end of function*/
        $(function(){
            $('.filter').on('click', function(){

                 var filters = [];
                $('.filter').each(function(){

                    if($(this).prop('checked')){

                        var filterName = $(this).data('filter-name'),
                            filterValue = $(this).val() ;

                        var filter = {};
                        filter.filterName = filterName;
                        filter.filterValue = filterValue;
                        filters.push(filter);

                    }// eof if

                    //console.log('inside filters each');
                   // console.log(filters);

                }); //eof each
                console.log(filters);

                 $.ajax({

                        method:'POST',
                        url: url,
                        data: { filters : filters , _token: token },
                        //success
                        success: function(data) {

                           // console.log(data);
                            $(".restaurant-item").empty();

                            $.each(data, function(index, value) {

                                var   output = "<div class='panel panel-default  panel--styled'>"

                                    + "<div class='panel-body'>"
                                    + "<div class='col-md-12 panelTop'>"
                                    + "<div class='col-md-4'>"
                                    + "<img class='img-responsive' src='http://placehold.it/350x350' alt=''/>"
                                    + "</div>"
                                    + "<div class='col-md-8'>"
                                    + "<small>" + value.cuisine + "</small>"
                                    + "<h4>" + value.business_name + "</h4>"
                                    + "<p>" +  value.description + "</p>"
                                    + "</div>"
                                    + "</div>"

                                    + "<div class='col-md-12 panelBottom'>"
                                    + "<div class='col-md-4 text-center'>"

                                    + "<label class='switch'>"

                                    + "<input type='checkbox'>"
                                    + "<div class='slider round'></div>"
                                    + "</label>"
                                    + "</div>"
                                    + "<div class='col-md-4 text-left'>"
                                    + "<span class='tel'>" + value.business_phone1 + "</span>"
                                    + "</div>"
                                    + "<div class='col-md-4'>"
                                    + "<div id='stars-existing' class='starrr' data-rating='4'></div>"
                                    + "</div>"
                                    + "</div>"
                                    + "</div>"
                                    + "</div>";
                                    $(".restaurant-item").append(output);
                         }); //eof foreach

                        },
                        //error
                        error : function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                            console.log('inside error');
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });

            });


        });


        $(document).on('click', '.panel-heading span.clickable', function(e){
            var $this = $(this);
            if(!$this.hasClass('panel-collapsed')) {
                $this.parents('.panel').find('.panel-body').slideUp();
                $this.addClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
            } else {
                $this.parents('.panel').find('.panel-body').slideDown();
                $this.removeClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
            }
        })

    </script>
@endsection
