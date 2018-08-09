<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>BoolBnb</title>
        
        {{-- Fonts --}}
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        
        {{-- Js Libraries --}}
        <script src="{{ asset('js/libraries.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        {{-- Google API --}}
        <script src=" {{ config('external_api.google_maps.base_path') }}&key={{ config('external_api.google_maps.api_key') }}"></script>
        
        {{-- Style --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,300,400,600,700" rel="stylesheet">


    </head>
    <body>

        <div class="container-fluid">
            <div class="row top_cnt">
                <div class="image_background">
                    <div class="overlay"></div>
                    <nav class="col-xs-12">
                        <div class="heading">
                            <a href="{{ route('welcome') }}">BoolBnb</a>
                        </div>
                        <div class="auth_cnt">
                            <div id="hamburger_icon" class="hamburger_menu">
                                <i class="fas fa-2x fa-bars"></i>
                                @include('components.slide_menu')
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

                    <div class="form_cnt col-xs-12 col-sm-10">                        
                        <form id="apartment_search_form" class="search_form_validation" action="{{ route('apartments.results') }}" method="GET">
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

                            <div class="filter_cnt d_none">

                                <div class="input_wrapper">

                                    <div class="flex_input_cnt">
    
                                        <div class="form-group flex_input{{ $errors->has('beds_number') ? 'has-error' : '' }}">                                    
                                            <div class="">
                                                <input id="beds_number" type="text" class="" name="beds_number" value="" placeholder="Quanti posti letto">   
                                            </div>
                                        </div>
                                    
                                        <div class="form-group flex_input{{ $errors->has('bathrooms_number') ? 'has-error' : '' }}">                                    
                                            <div class="">
                                                <input id="bathrooms_number" type="text" class="" name="bathrooms_number" value="" placeholder="Quanti bagni">   
                                            </div>
                                        </div>
    
                                    </div>
                                
                                    <div class="form-group{{ $errors->has('distance') ? 'has-error' : '' }}">                                    
                                        <div class="">
                                            <input id="distance" type="text" class="" name="distance" value="" placeholder="Raggio di ricerca in Km">   
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group checkbox_list_cnt{{ $errors->has('features') ? ' has-error' : '' }}">
                                    <ul class="checkbox_list">
                                        @foreach($check_not_check as $feat) 
                                            <li class="checkbox_item_cnt">
                                                <input type="checkbox" class="custom_checkbox" name="features[]" id="{{ $feat['name'] }}" value="{{ $feat['id'] }}" {{ $feat['isChecked'] ? 'checked' : null}}> 
                                                <label class="" for="{{ $feat['name'] }}">{{ $feat['name'] }}</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>                           
                                
                            </div>

                            <div class="buttons_cnt">
                                
                                <i id="hide_filters" class="far fa-2x fa-times-circle hidden"></i>
                                
                                <a id="show_filters" class="show_filter custom_button">
                                    Ricerca avanzata
                                </a>
                                    
                                <button type="submit" class="custom_button">
                                    Cerca
                                </button>
                            </div>
                        </form>                  
                    </div>
                </div>
            </div>

            <div class="row bottom_cnt">
                
                @if( !empty($apartmentsToShow[0]['apartment']) )
                    <h1 class="evidence">In evidenza: </h1>
                    <div id="apartments_advertised_cnt" class="results-cnt">
                        @include('components.apartments_cards')                        
                    </div>
                @else 
                    <div class="alert_message col-md-8 col-md-offset-2">
                        Non ci sono appartamenti sponsorizzati    
                    </div>   
                @endif

            </div>

            <div class="row footer">
                <footer class="col-xs-12">
                    <div class="content_cnt">
                        <div class="content_heading">made by</div>
                        <div class="content_authors">
                            
                            <p class="author"> 
                                <span class="name a_right"><span class="initial">A</span>lessandro</span> 
                                <span class="name a_right"><span class="initial"> L</span>ausdei</span>
                            </p>
                            <p class="bind">
                                <span>&amp;</span>
                            </p>
                            <p class="author"> 
                                <span class="name a_left"><span class="initial">D</span>avide</span> 
                                <span class="name a_left"><span class="initial"> L</span>ecci</span>
                            </p>    
                            
                        </p>
                    </div>

                </footer>
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
