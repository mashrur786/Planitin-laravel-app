@extends('layouts.app')

@section('style')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('partials.restaurants.single')
            </div>
        </div>
    </div>
@endsection

@section('script')
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
   <script>
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
   </script>

@endsection