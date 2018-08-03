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
        <script src="{{ asset('js/libraries.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        <script src=" {{ config('external_api.google_maps.base_path') }}&key={{ config('external_api.google_maps.api_key') }}"></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,300,400,600,700" rel="stylesheet">


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

        <div class="container-fluid">
            <div class="row top_cnt">
                <div class="image_background">
                    <nav class="col-xs-12">
                        <div class="heading">
                            <a href="{{ route('welcome') }}">BoolBnb</a>
                        </div>
                        <div class="auth_cnt">
                            <div class="hamburger_menu">
                                <i class="fas fa-2x fa-bars"></i>
                            </div>
                            <div class="menu_items">
                                @if (Route::has('login'))
                                    @auth
                                        <a href="{{ route('home') }}">Profile</a>
                                        <a href="{{ route('inbox.show') }}">Inbox</a>  
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}">Login</a>
                                        <a href="{{ route('register') }}">Register</a>
                                    @endauth
                                @endif
                            </div>
                        </div>
                    </nav>

                    <div class="form_cnt col-xs-12">                        
                        <form id="apartment_search_form" class="filter_form_validation" action="{{ route('apartments.results') }}" method="GET">
                            <div class="form-group{{ $errors->has('address') ? 'has-error' : '' }}">                                
                                <div class="">
                                    <input id="address" type="text" class="" name="address" value="" >   
                                </div>
                            </div>

                            <div class="hidden form-group{{ $errors->has('lat') ? ' has-error' : '' }}">
                                <div class="col-md-9">
                                    <input id="lat" type="hidden" class="form-control" name="lat" value="" >
                                </div>
                            </div>

                            <div class="hidden form-group{{ $errors->has('lng') ? ' has-error' : '' }}">
                                <div class="col-md-9">
                                    <input id="lng" type="hidden" class="form-control" name="lng" value="" >
                                </div>
                            </div>                            

                            <div class="filter_cnt hidden">

                                <div class="input_wrapper">

                                    <div class="flex_input_cnt">
    
                                        <div class="form-group flex_input{{ $errors->has('beds_number') ? 'has-error' : '' }}">                                    
                                            <div class="">
                                                <input id="beds_number" type="number" class="" name="beds_number" value="" placeholder="Quanti posti letto">   
                                            </div>
                                        </div>
                                    
                                        <div class="form-group flex_input{{ $errors->has('bathrooms_number') ? 'has-error' : '' }}">                                    
                                            <div class="">
                                                <input id="bathrooms_number" type="number" class="" name="bathrooms_number" value="" placeholder="Quanti bagni">   
                                            </div>
                                        </div>
    
                                    </div>
                                
                                    <div class="form-group{{ $errors->has('distance') ? 'has-error' : '' }}">                                    
                                        <div class="">
                                            <input id="distance" type="number" class="" name="distance" value="" placeholder="Raggio di ricerca in Km">   
                                        </div>
                                    </div>
                                </div>

                                
                                
                            
                                <div class="form-group checkbox_list_cnt{{ $errors->has('features') ? ' has-error' : '' }}">
                                    <ul class="checkbox_list">
                                        @foreach($check_not_check as $feat) 
                                            <li class="checkbox_item_cnt">
                                                {{-- <label class="checkbox_item" for="{{ $feat['name'] }}">{{ $feat['name'] }}
                                                    <input class="custom_checkbox" type="checkbox" name="features[]" id="{{ $feat['name'] }}" {{ $feat['isChecked'] ? 'checked' : null}}>
                                                    <span class="checkmark"></span>
                                                </label> --}}
                                                <input type="checkbox" class="custom_checkbox" name="features[]" id="{{ $feat['name'] }}" value="{{ $feat['id'] }}" {{ $feat['isChecked'] ? 'checked' : null}} autofocus> 
                                                <label class="" for="{{ $feat['name'] }}">{{ $feat['name'] }}</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>                           
                                
                            </div>

                            <button class="btn btn-primary show_filter">
                                Ricerca avanzata
                            </button>
                                
                            <button type="submit" class="btn btn-primary">
                                Cerca
                            </button>
                        </form>                  
                    </div>
                </div>
            </div>

            <div class="row bottom_cnt">
                
                @if( !empty($apartmentsToShow[0]['apartment']) )
                    <div id="apartments_advertised_cnt" class="results-cnt">
                        @include('components.apartments_cards')                        
                    </div>
                @else 
                    <div class="alert_message col-md-8 col-md-offset-2">
                        Non ci sono appartamenti sponsorizzati    
                    </div>   
                @endif

            </div>
        </div>

        

        
        
    </body>
    <script>
        $(document).ready(function() {
            $("#address").geocomplete({ 
                details: "#apartment_search_form" 
            });
        });        
    </script>
</html>
