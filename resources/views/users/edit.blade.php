@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card hovercard">
                <div class="cardheader">
                </div>
                <div class="avatar">
                    <img alt="" src="http://wfarm2.dataknet.com/static/resources/icons/set112/1df88523.png">
                </div>
                <div class="info">
                    <div class="title">
                        <a target="_blank" href="http://scripteden.com/">
                            {{ Auth::user()->name }}
                        </a>
                    </div>
                    <hr>
                    <div class="desc">
                        {{ Auth::user()->email }}
                    </div>
                    <hr>
                </div>
                <div class="bottom">

                    <a href="{{ url('/home') }}" class="btn btn-primary">Parks & Deals</a>
                </div>
            </div>

        </div>
        <div class="col-md-9">

            {{-- eof restaurant card --}}

            {{-- X--}}
            <div class="container-fluid">
                <div class="container-pad" id="property-listings">

                    <div class="row">
                      <div class="col-md-12">
                        <h1 style="margin-top: 0">My Account</h1>
                      </div>

                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div class="panel panel-default">

                            <div class="panel-body">
                                <form method="post" action="{{ route('home.user.update', Auth::user()->id ) }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                                    </div>
                                    <div class="form-group">
                                         <label for="password">Password</label>
                                         <input  id="password" type="password" name="password" class="form-control" placeholder="Password.." required>
                                    </div>
                                    <div class="form-group">
                                         <label for="">Confirm Password</label>
                                         <input id="confirm_password" type="password" name="confirm_password" class="form-control" placeholder="confirm password.." required>
                                    </div>
                                    <div class="form-group">
                                            <button class="btn btn-primary" type="submit"> Save </button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div><!-- End row -->
                </div><!-- End container -->
            </div>
            {{-- X --}}

        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm_password");

        function validatePassword(){
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
@endsection