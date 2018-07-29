<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        <title>Laravel</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        
         {{-- libraries --}}
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/libraries.js') }}"></script>

        <script src=" {{ config('external_api.google_maps.base_path') }}&key={{ config('external_api.google_maps.api_key') }}"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('home') }}">Personal Account</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    BoolBnb
                </div>
            <form id="apartment_search_form" action="{{ route('apartments.results') }}" method="get">
                    
                    <input class="form-group" id="address" name="address" type="text" placeholder="Inserisci indirizzo" request autofocus>
                    <div class="hidden form-group{{ $errors->has('lat') ? ' has-error' : '' }}">
                        <div class="col-md-9">
                            <input id="lat" type="hidden" class="form-control" name="lat" value="{{ old('lat') }}" >
                        </div>
                    </div>

                    <div class="hidden form-group{{ $errors->has('lng') ? ' has-error' : '' }}">
                        <div class="col-md-9">
                            <input id="lng" type="hidden" class="form-control" name="lng" value="{{ old('lng') }}" >
                        </div>
                    </div>
                    {{-- FILTRI --}}
                    
                    <input class="form-group" type="number" name="beds_number" id="" placeholder="Numero min. di letti">
                    <input class="form-group" type="number" name="bathrooms_number" id="" placeholder="Numero min. di bagni">
                    <input class="form-group" type="text" name="distance" id="" placeholder="Cerca in un raggio di ... Km">
                    
                    @foreach($features as $feature)
                    <label for="{{ $feature['id'] }}"> {{ $feature['name'] }} </label>
                    <input type="checkbox" name="features[]" id="{{ $feature['id'] }}" value="{{ $feature['id'] }}">
                    @endforeach
                
                    <input type="submit" value="Cerca">
                </form>

                {{-- 
                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div> --}}
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function() {
            $("#address").geocomplete({ 
                details: "#apartment_search_form" 
            });
        })

        
    </script>
</html>
