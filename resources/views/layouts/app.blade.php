<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        

        {{-- libraries --}}
        {{-- <script src="{{ asset('js/jquery-3.3.1.js') }}"></script> --}}
        <script src="{{ asset('js/libraries.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        {{-- <script src="{{ asset('js/.js') }}"></script> --}}

        <script src=" {{ config('external_api.google_maps.base_path') }}&amp;key={{ config('external_api.google_maps.api_key') }}"></script>

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Styles -->        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">        
        <link rel="stylesheet" href="{{ asset('css/libs/dropzone.css') }}"> {{-- Dropzone --}}
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,300,400,600,700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
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
                            @guest
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                                <li>
                                    <a href="{{ route('home') }}" class="dropdown-toggle">
                                        {{ Auth::user()->name }} 
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('inbox.show') }}">
                                        Inbox
                                    </a>                                        
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>                                     

                            @endguest
                            
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')
        </div>
        
        @yield('additional-scripts')
        
    </body>
</html>
