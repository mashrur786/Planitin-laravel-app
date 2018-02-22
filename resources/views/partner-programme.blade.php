@extends('layouts.app')

@section('style')
<style type="text/css">
  ul {list-style:none;} /* you should use a css reset too... ;) */
    ul li {
        margin-bottom: 30px;
        font-size: 1.2em;
    }

    ul li i.ion-android-radio-button-on {
        color: #337ab7;
        margin-right: 15px;
    }

</style>
@endsection
@section('content')
    <br>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Partner Business Programme</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <hr>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <p>
                Build a strong relationship with new and existing customers by
            partnering with our trending online loyalty and deals programme.
            </p>
            <br><br>
            <div class="text-center">
                <Button class="btn btn-white"><a href="{{ route('contact.create') }}">Contact Us</a></Button>
            </div>
            <br><br>
            <br>

            <p>
                RESTAURANTS CAFÉ’S DESSERTS TAKEAWAYS DRINKS AND MORE...
            </p>
            <br>
            <h3>5 TOP REASONS TO USE OUR SERVICE: </h3>
            <br>
            <ul>

                <li> <i class="ion-android-radio-button-on"></i> Invite more customers on the less busier days</li>
                <li><i class="ion-android-radio-button-on"></i> Build a loyalty programme to keep old customers happy!</li>
                <li> <i class="ion-android-radio-button-on"></i> Based on feedback, customers are more willing to buy when they receive a good deal</li>
                <li> <i class="ion-android-radio-button-on"></i> Our service allows nearby commuters to find you much quicker</li>
                <li><i class="ion-android-radio-button-on"></i> STAND OUT FROM YOUR COMPETITION!</li>
                <li><i class="ion-android-radio-button-on"></i> GIVE YOUR CUSTOMERS A REASON TO COME BACK!</li>

            </ul>
            <hr>
            <div class="text-center">

                 <br><br>
                <p>
                   TO BECOME A PARTNER
                </p>
                <Button class="btn btn-white"><a href="{{ route('contact.create') }}">Contact Now</a></Button>



            </div>


        </div>


    </div>

</div>

    <br><br><br>

@endsection