<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Plan It In ') }}</title>

    <!-- Styles -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    {{-- Jquery UI css theme --}}
    <link href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <!-- bootstrap select stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    {{-- ionic Icon set --}}
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- font awesome icon set--}}
    <link rel="stylesheet" href="/backend/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/flexslider.css">
    @yield('style')
    {{-- Main CSS--}}
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/@media-max1199px-min992px.css">
    <link rel="stylesheet" href="/css/@media-max991px-min768px.css">
    <link rel="stylesheet" href="/css/@media-max767px-min481px.css">
    <link rel="stylesheet" href="/css/@media-max480px-min320px.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

    <header>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img width="150px" src="/images/logo1.png" alt="">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            {{-- notification --}}
                            <li class="dropdown" onclick="markNotificationsAsRead()">
                                <a href="#" class="dropdown-toggle notifications-trigger" data-toggle="dropdown" role="button" aria-expanded="false">

                                    <i class="ion-earth"></i>
                                    Notifications
                                     <span class="badge">{{ count(Auth::user()->unreadNotifications) }}</span>
                                </a>

                                <ul class="dropdown-menu notifications" role="menu">
                                    @forelse(Auth::user()->unreadNotifications as $unreadNotification)

                                        <?php

                                            $restaurant = App\Restaurant::find($unreadNotification->data['campaign']['restaurant_id'])

                                        ?>
                                        <li>
                                            <div>
                                                <img class="img-circle"  src="/uploads/restaurant_imgs/{{ $restaurant->featured_img }}" >
                                            </div>
                                            <div>
                                                <a href="{{ route('home.campaigns.show', $unreadNotification->data['campaign']['id']) }}">
                                                    <span class="label label-info">
                                                        {{ $unreadNotification->data['campaign']['title'] }}
                                                    </span>
                                                </a>
                                                <br>
                                                New deal form <strong>{{ $restaurant->business_name }} </strong>
                                                Expires:

                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $unreadNotification->data['campaign']['expires'] )->format('F j, Y , g:i A') }}
                                            </div>
                                        </li>
                                        @empty
                                        <li>
                                            No New Notifications
                                        </li>
                                    @endforelse
                                </ul>
                            </li>
                            {{--  eof notification --}}

                            {{-- user account --}}
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/home') }}">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            {{-- eof user acount --}}
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        @include('partials.messages')
        @yield('content')
        <div class="clearfix"></div>
    </main>
    @include('partials.footer')
    <!-- Scripts -->
    {{-- Jquery 3.1.1 minifield --}}
    <script
            src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script
            src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
            integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
            crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript for bootstrap-select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('script')

</body>
</html>
