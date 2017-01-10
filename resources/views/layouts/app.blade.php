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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <style type="text/css">
        .success-message {
            text-align: center;
            color: blue;
            width: 100%;
            font-weight: bold;
            background: yellow;
        }
        .error-message {
            text-align: center;
            color: red;
            width: 80%;
            font-weight: bold;
            background: yellow;
        }
    </style>
    <script src="/js/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="/js/bootstrap.min.js" crossorigin="anonymous"></script>
    
    <script src="/js/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
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
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Marron') }}
                    </a>
                    @if (!Auth::guest())
                        @if (Auth::user()->hasRole(\App\User::ROLE_ADMIN))
                            <a class="navbar-brand" href="{{ url('/admin') }}">ADMIN</a>
                            <a class="navbar-brand" href="{{ url('admin/Table/table') }}">Table</a>
                            <a class="navbar-brand" href="{{ url('admin/Category/category') }}">Category</a>
                            <a class="navbar-brand" href="{{ url('admin/Product/product') }}">Product</a>
                            <a class="navbar-brand" href="{{ url('admin/User/users') }}">User</a>
                        @elseif (Auth::user()->hasRole(\App\User::ROLE_ORDER))
                            <a class="navbar-brand" href="{{ url('/order') }}">Order</a>
                        @elseif (Auth::user()->hasRole(\App\User::ROLE_CHEF))
                            <a class="navbar-brand" href="{{ url('/chef') }}">CHEF</a>
                        @elseif (Auth::user()->hasRole(\App\User::ROLE_BAR))
                            <a class="navbar-brand" href="{{ url('/bar') }}">BAR</a>
                        @endif
                    @else
                    @endif
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

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
