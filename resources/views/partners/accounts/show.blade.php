@extends('partners.dashboard')

@section('content')
    <h1>Account</h1>
    <div class="alert alert-info">
                Contact Admin to change your or your business details
            </div>
    <div class="card">
        <div class="card-info">

            <ul>
                <span class="label label-info pull-right">
                    Member since: {{ date("M d, Y",strtotime(Auth::user()->created_at))  }}
                </span>
                <li>
                    <div class="title inline">Email: </div>
                    <div class="value inline" >{{  Auth::user()->email }}</div>
                </li>
                <li>
                     <div class="title inline"> Business Name: </div>
                     <div class="value inline" >{{  Auth::user()->business->business_name }}</div>
                </li>
                <li>
                    <div class="title inline"> Business Type: </div>
                    <div class="value inline" >{{  Auth::user()->business->type }}</div>
                </li>
                <li>
                    <div class="title inline"> Cuisine: </div>
                    <div class="value inline" >{{  Auth::user()->business->cuisine }}</div>
                </li>
                <li>
                    <div class="title inline"> Description: </div>
                    <div class="value inline" >{{  Auth::user()->business->description }}</div>
                </li>
                <li>
                    <div class="title inline"> Capstone: </div>
                    <div class="value inline" >{{  Auth::user()->business->capstone }}</div>
                </li>
                <li>
                    <div class="title inline"> Business Phone: </div>
                    <div class="value inline" >{{  Auth::user()->business->business_phone1 }}</div>
                </li>
                <li>
                    <div class="title inline"> Extra Business Phone (optional): </div>
                    <div class="value inline" >{{  Auth::user()->business->business_phone2 }}</div>
                </li>
                <li>
                    <div class="title"> Address: </div>
                    <br>
                    <div class="value inline">
                        <p style="m-left: 0px">
                        {{  Auth::user()->business->address }} <br>
                        {{  Auth::user()->business->street }} <br>
                        {{  Auth::user()->business->area }} <br>
                        {{  Auth::user()->business->town }} <br>
                        {{  Auth::user()->business->county }} <br>
                            {{  Auth::user()->business->outcode . ' ' . Auth::user()->business->incode }}
                        </p>

                        <br>

                    </div>
                </li>
                <li>
                    <div class="title inline"> Business Website </div>
                    <div class="value inline" >{{  Auth::user()->business->website }}</div>
                </li>
                <li>
                    <div class="title inline"> Contact Name </div>
                    <div class="value inline" >{{  Auth::user()->business->contact_name }}</div>
                </li>
                <li>
                     <div class="title inline"> Contact Telephone </div>
                     <div class="value inline" >{{  Auth::user()->business->contact_phone }}</div>
                </li>
                <a href="{{ route('partner.dashboard') }}" class="btn">Back</a>
            </ul>
        </div>
    </div>

@endsection