<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.css" />
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css" />
    <link href="{{URL::asset('calendar/fullcalendar.min.css')}}" rel='stylesheet' />
    <link href="{{URL::asset('calendar/fullcalendar.print.min.css')}}" rel='stylesheet' media='print' />



    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app" class="emptyMe">
    <nav class="navbar navbar-default navbar-static-top">
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
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{'Home' }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())

                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else

                        <li><a data-toggle="modal" data-target="#myModal" href=""><img src="/images/calendar.png">Calendar</a></li>
                        <li class="showmessage"><a href="/messages"><img src="/images/message-icon.png"> Messages <span class="badge pull-right online">  </span></a>  </li>
                        <li><a href="/addnews"><img src="/images/news-icon.png">Add News</a></li>

                        <li><a href="/news"><img src="/images/newspaper-icon.png"> News</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">

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
                    @endif
                </ul>
            </div>
        </div>
    </nav>


</div>
@yield('content')




<!-- Scripts -->
<script src="/js/app.js"></script>
<!--<script src="/js/bootstrap.js"></script>-->
<script src="/js/jquery-3.1.0.js"></script>
<script src="/js/init.js"></script>
<script src="/js/countmessage.js"></script>
<script src="/js/pagination.js"></script>
<script src="{{URL::asset('calendar/lib/jquery.min.js')}}"></script>
<script src="{{URL::asset('calendar/lib/moment.min.js')}}"></script>
<script src="{{URL::asset('calendar/fullcalendar.js')}}"></script>
<script src="{{URL::asset('calendar/calendar.js')}}"></script>
</body>
</html>
