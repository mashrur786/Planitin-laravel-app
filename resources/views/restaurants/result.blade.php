@extends('layouts.app')
{{-- Stylesheet--}}
@section('style')
    <style>
        /*----------------------
Product Card Styles
----------------------*/
        .panel.panel--styled {
            background: #F4F2F3;
        }
        .panelTop {
            padding: 30px;
        }

        .panelBottom {
            border-top: 1px solid #e7e7e7;
            padding-top: 20px;
        }
        .btn-add-to-cart {
            background: #FD5A5B;
            color: #fff;
        }
        .btn.btn-add-to-cart.focus, .btn.btn-add-to-cart:focus, .btn.btn-add-to-cart:hover  {
            color: #fff;
            background: #FD7172;
            outline: none;
        }
        .btn-add-to-cart:active {
            background: #F9494B;
            outline: none;
        }


        span.itemPrice {
            font-size: 24px;
            color: #FA5B58;
        }

        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {display:none;}

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }


    </style>
@endsection
{{-- Content--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default  panel--styled">
                    <div class="panel-body">
                        <div class="col-md-12 panelTop">
                            <div class="col-md-4">
                                <img class="img-responsive" src="http://placehold.it/350x350" alt=""/>
                            </div>
                            <div class="col-md-8">
                                <small>{{ $restaurant_info->cuisine  }}</small>
                                <h2>{{ $restaurant_info->business_name }}</h2>
                                <p>{{ $restaurant_info->description }}</p>
                                <address>
                                    <strong>{{ $restaurant_info->address }}</strong><br>
                                    {{ $restaurant_info->street }}<br>
                                    {{ $restaurant_info->town }}<br>
                                    {{ $restaurant_info->postcode }}<br>
                                </address>
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
                                <h5><span class="itemPrice">{{ $restaurant_info->business_phone1 }}</span></h5>
                            </div>
                            <div class="col-md-4">
                                <div id="stars-existing" class="starrr" data-rating='4'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- Script--}}
@section('script')
    <script>
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