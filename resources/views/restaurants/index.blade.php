@extends('layouts.app')

@section('style')
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" href="/css/recipe-card.css">
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3 filters">
                <br>
                <h3 class="">Filter Results</h3>
                <br>
                <br/>
                <div class="panel panel-filter">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cuisines</h3>
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                    </div>
                    <div class="panel-body">
                         <div class="control-group">

                        @foreach ($cuisines as $cuisine => $total)

                            <label class="control control-checkbox">
                               {{ ucfirst(trans($cuisine)) }}  ( {{ $total }} )
                                <input data-filter-name="cuisine" class="filter" type="checkbox" value="{{ ucfirst(trans($cuisine))  }}">
                                <div class="control_indicator"></div>
                            </label>
                        @endforeach
                         </div>

                    </div>
                </div>
                <div class="panel panel-filter">
                    <div class="panel-heading">
                        <h3 class="panel-title">Restaurants</h3>
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                    </div>
                    <div class="panel-body">

                        <div class="control-group">
                        @foreach ($types as $type)
                            <label class="control control-checkbox">
                               {{ ucfirst(trans($type->type))  }}s
                                <input data-filter-name="type" class="filter" type="checkbox" value="{{ ucfirst(trans($type->type))  }}">
                                <div class="control_indicator"></div>
                            </label>
                        @endforeach
                        </div>

                    </div>
                </div>
                <div class="panel panel-filter">
                    <div class="panel-heading">
                        <h3 class="panel-title">Requirements</h3>
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                    </div>
                    <div class="panel-body">

                        <div class="control-group">
                        @foreach ($requirements as $requirement)
                             <label class="control control-checkbox">
                               {{ ucfirst(trans($requirement->name))  }}
                                <input data-filter-name="requirement" class="filter" type="checkbox" value="{{ ucfirst(trans($requirement->name))  }}">
                                <div class="control_indicator"></div>
                            </label>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="col-md-9" >
                <h1 style="margin-top: 0">We have found <span id="resultNo"> {{  $data->count() }} </span> results</h1>
            </div>
            <br>
            <div class="col-md-9">

              <form class="autocomplete-search-form" onsubmit="event.preventDefault();">
                  <input id="res-name" name="resName" type="text" class="form-control" placeholder="Search restaurant by name">
              </form>

            </div>

            <div class="col-md-9 restaurants">
                <div class="row">
                    @if(!$data->isEmpty())
                    @foreach ($data as $restaurant)
                         {{-- CARD --}}
                         <div class="col-md-6">
                <div class="recipe-card">
                    <aside>
                        <img class="img-responsive" src="/uploads/restaurant_imgs/{{ $restaurant->featured_img or 'default.png' }}" alt=""/>
                        <p>
                           <span class="label label-info"> {{ ucfirst(trans($restaurant->cuisine))  }}</span>
                        </p>


                    </aside>
                    <article>
                        <h2>
                            <a href="/restaurants/{{ $restaurant->id }}">{{ ucwords($restaurant->business_name) }} </a>
                            <div class="rateYo" data-rateyo-rating="{{ $restaurant->isRated() ? $restaurant->avgRating : 0 }}"></div>
                        </h2>
                        <h4> {{ $restaurant->business_phone1}}</h4>
                        <hr>
                        <ul>
                            <li><span class="ion-ios-location-outline"></span> {{ $restaurant->address }},</li>
                            <li>{{ $restaurant->street }},</li>
                            <li> {{ $restaurant->town }},</li>
                            <li>{{ $restaurant->outcode . ' ' . $restaurant->incode }}</li>
                        </ul>
                        <hr>
                        <p>
                             @foreach($restaurant->requirements as $requirement)
                                 <span class="label label-white">
                                     {{ $requirement->name }}
                                 </span>
                             @endforeach
                        </p>

                    </article>
                </div>
            </div>

                    @endforeach
                @else
                </div>
                <div class="alert alert-danger">
                    <strong>Oosp!!</strong> We didn't find any restuarants, please try again !!
                </div>
                    <a href="{{ route('welcome') }}">
                        <button type="button" class="btn btn-info btn-lg">Back</button>
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
    <script src="/js/jquery.matchHeight-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/2.3.0/mustache.js"></script>
    <script id="res-template" type="text/template">
          <div class="col-md-6">
                <div class="recipe-card">
                    <aside>
                         @{{#data.featured_img}}
                          <img class="img-responsive" src="/uploads/restaurant_imgs/@{{data.featured_img}}" alt=""/>
                         @{{/data.featured_img}}
                         @{{^data.featured_img}}
                          <img class="img-responsive" src="/uploads/restaurant_imgs/default.png" alt=""/>
                         @{{/data.featured_img}}
                        <p>
                           <span class="label label-info"> @{{ data.cuisine  }}</span>
                        </p>


                    </aside>
                    <article>
                        <h2>
                            <a href="/restaurants/@{{ data.id }}"> @{{ data.business_name }} </a>
                            {{-- rating --}}
                              @{{#data.ratings_average}}
                              <div class="rateYo" data-rateyo-rating="@{{ data.ratings_average }}"></div>
                              @{{/data.ratings_average}}
                              @{{^data.ratings_average}}
                              <div class="rateYo" data-rateyo-rating="0"></div>
                              @{{/data.ratings_average}}
                            {{-- /rating--}}
                        </h2>
                        <h4> @{{ data.business_phone1 }}</h4>
                        <hr>
                        <ul>
                            <li><span class="ion-ios-location-outline"></span> @{{ data.address }},</li>
                            <li> @{{ data.street }},</li>
                            <li> @{{ data.town }},</li>
                            <li> @{{ data.outcode . ' ' . data.incode }}</li>
                        </ul>
                        <hr>
                        <p>
                            {{-- @foreach($restaurant->requirements as $requirement)
                                 <span class="label label-white">
                                     {{ $requirement->name }}
                                 </span>
                             @endforeach--}}
                        </p>
                    </article>
                </div>
            </div>
        {{--<div class="panel panel-default panel--styled restaurant">
                        <div class="panel-body">
                                <div class="col-md-4 image">
                                    @{{#data.featured_img}}
                                      <img class="img-responsive" src="/uploads/restaurant_imgs/@{{data.featured_img}}" alt=""/>
                                    @{{/data.featured_img}}
                                    @{{^data.featured_img}}
                                      <img class="img-responsive" src="/uploads/restaurant_imgs/default.png" alt=""/>
                                    @{{/data.featured_img}}
                                </div>
                                <div class="col-md-8 info">
                                    <span class="label label-primary">@{{ data.cuisine  }}</span>
                                    <a class="pull-right" href="/restaurants/@{{ data.id }}"><button class="btn btn-primary"> view Deals </button></a>
                                      --}}{{-- rating --}}{{--
                                      @{{#data.ratings_average}}
                                      <div class="rateYo" data-rateyo-rating="@{{ data.ratings_average }}"></div>
                                      @{{/data.ratings_average}}
                                      @{{^data.ratings_average}}
                                      <div class="rateYo" data-rateyo-rating="0"></div>
                                      @{{/data.ratings_average}}
                                    --}}{{-- /rating--}}{{--
                                    <h3><a href="/restaurants/@{{ data.id }}"> @{{ data.business_name }} </a></h3>
                                    <div class="address">
                                        <p>
                                            <span class="ion-ios-location-outline"></span>
                                            @{{ data.address }}, @{{ data.street }}, @{{ data.town }}
                                            <br>
                                            @{{ data.outcode }} @{{ data.incode }}
                                        </p>
                                    </div>

                                </div>
                        </div>
                    </div>--}}
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>

        var template = $("#res-template").html();
        var resultCount = 0;
        // bof function for restaurant name auto-complete search
        // bof get restaurants by id
        $(function(){

            $("#res-name").autocomplete({

                source: "{{ URL::route('restaurants.autocompleteSearch') }}",
                minLength: 3,
                select: function( event, ui ) {

                    var id = ui.item.id ;

                    $.ajax({

                        method:'POST',
                        url: '{{ route('restaurants.sortById') }}',
                        data: { 'id' : id , _token: token },
                        //success
                        success: function(data) {

                            resultCount = data.length;
                            $(".restaurants").empty();
                            var data = {
                                  "data": data[0]
                                };
                            var html = Mustache.render(template, data);
                            $(".restaurants").append(html);

                        },
                        //error
                        error : function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                            console.log('inside error');
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    }).done(function(){
                        $('#resultNo').html(resultCount);
                        $('.rateYo').each(function(){
                            var $rateYo = $(this).rateYo({
                                    ratedFill: "#008dc9",
                                    readOnly: true,
                                    starWidth: "20px"
                            });

                        });
                 });

                }

            });

        });//end of function*/
        // eof get restaurants by id
        // eof function for restaurant name auto-complete search

        /* bof ajax call by filter */
        $(function(){

            $('.filter').on('click', function(){

                 var filters = []; //filter array

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
                }); //eof each
                //console.log(filters);
                 $.ajax({
                        method:'POST',
                        url: url,
                        data: { filters : filters , _token: token },
                        //success
                        success: function(data) {

                            resultCount = data.length;
                            $(".restaurants").empty();
                            $.each(data, function(index, value) {

                                var data = {
                                  "data": value
                                };
                                var html = Mustache.render(template, data);

                                $(".restaurants").append(html);
                            }); //eof foreach
                        },
                        //error
                        error : function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                            console.log('inside error');
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                 }).done(function(){
                        $('#resultNo').html(resultCount);
                        $('.recipe-card').matchHeight();
                        $('.rateYo').each(function(){
                            var $rateYo = $(this).rateYo({
                                    ratedFill: "#008dc9",
                                    readOnly: true,
                                    starWidth: "20px"
                            });

                        });
                 });

            });


        });
        /* eof ajax call by filter */

        /* bof filter panel slide up */
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
        });

        /* rate yo*/
          $(function(){
                  $('.rateYo').each(function(){
                    var $rateYo = $(this).rateYo({
                            ratedFill: "#008dc9",
                            readOnly: true,
                            starWidth: "20px"
                        });
                    /* set the option `onChange` */
                });
          });

           $(function() {
                $('.recipe-card').matchHeight();
            });

    </script>
@endsection
