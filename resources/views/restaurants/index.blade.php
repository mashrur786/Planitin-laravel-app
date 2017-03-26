@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 filters">

                <a href="" class="btn btn-info btn-block btn-compose-email">Filter Results</a>
                <br/>
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
                        <h3 class="panel-title">Ratings</h3>
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                    </div>
                    <div class="panel-body">
                        <div class="checkbox">
                            <ul>
                                <li> <label><input type="checkbox" value="5">
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                    </label>
                                </li>
                                <li>
                                    <label><input type="checkbox" value="4">
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                    </label>
                                </li>
                                <li>
                                    <label><input type="checkbox" value="3">
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                    </label>
                                </li>
                                <li>
                                    <label><input type="checkbox" value="2">
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                    </label>
                                </li>
                                <li>
                                    <label><input type="checkbox" value="1">
                                        <i class="glyphicon glyphicon-star"></i>
                                    </label>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-8 restaurant-item">
                @foreach ($data as $restaurant)

                    <div class="panel panel-default  panel--styled">
                        <div class="panel-body">
                            <div class="col-md-12 panelTop">
                                <div class="col-md-4">
                                    <img class="img-responsive" src="http://placehold.it/350x350" alt=""/>
                                </div>
                                <div class="col-md-8">
                                    <small>{{ ucfirst(trans($restaurant->cuisine))  }}</small>
                                    <h4>{{ $restaurant->business_name }}</h4>
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

        $(document).on('click', '.filter', function(){

           var filterVal = $(this).val();
           var filterName = $(this).data('filter-name');


            $.ajax({
                method:'POST',
                url: url,
                data: { 'filter_name' : filterName,'filter_val' : filterVal, _token: token}
            }).done(function(data){

                $(".restaurant-item").empty();
                var output;

                $.each(data, function(index, value) {



                    output += "<div class='panel panel-default  panel--styled'>"

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


                });

                $(".restaurant-item").append(output);
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
        // Starrr plugin (https://github.com/dobtco/starrr)
        var __slice = [].slice;

        (function($, window) {
            var Starrr;

            Starrr = (function() {
                Starrr.prototype.defaults = {
                    rating: void 0,
                    numStars: 5,
                    change: function(e, value) {}
                };

                function Starrr($el, options) {
                    var i, _, _ref,
                            _this = this;

                    this.options = $.extend({}, this.defaults, options);
                    this.$el = $el;
                    _ref = this.defaults;
                    for (i in _ref) {
                        _ = _ref[i];
                        if (this.$el.data(i) != null) {
                            this.options[i] = this.$el.data(i);
                        }
                    }
                    this.createStars();
                    this.syncRating();
                    this.$el.on('mouseover.starrr', 'span', function(e) {
                        return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
                    });
                    this.$el.on('mouseout.starrr', function() {
                        return _this.syncRating();
                    });
                    this.$el.on('click.starrr', 'span', function(e) {
                        return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
                    });
                    this.$el.on('starrr:change', this.options.change);
                }

                Starrr.prototype.createStars = function() {
                    var _i, _ref, _results;

                    _results = [];
                    for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                        _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
                    }
                    return _results;
                };

                Starrr.prototype.setRating = function(rating) {
                    if (this.options.rating === rating) {
                        rating = void 0;
                    }
                    this.options.rating = rating;
                    this.syncRating();
                    return this.$el.trigger('starrr:change', rating);
                };

                Starrr.prototype.syncRating = function(rating) {
                    var i, _i, _j, _ref;

                    rating || (rating = this.options.rating);
                    if (rating) {
                        for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                            this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
                        }
                    }
                    if (rating && rating < 5) {
                        for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                            this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                        }
                    }
                    if (!rating) {
                        return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                    }
                };

                return Starrr;

            })();
            return $.fn.extend({
                starrr: function() {
                    var args, option;

                    option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                    return this.each(function() {
                        var data;

                        data = $(this).data('star-rating');
                        if (!data) {
                            $(this).data('star-rating', (data = new Starrr($(this), option)));
                        }
                        if (typeof option === 'string') {
                            return data[option].apply(data, args);
                        }
                    });
                }
            });
        })(window.jQuery, window);

        $(function() {
            return $(".starrr").starrr();
        });

        $( document ).ready(function() {

            $('#stars').on('starrr:change', function(e, value){
                $('#count').html(value);
            });

            $('#stars-existing').on('starrr:change', function(e, value){
                $('#count-existing').html(value);
            });
        });
    </script>
@endsection
