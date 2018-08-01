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
                            Boolbnb
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
                        {!! Form::open(['id' => $data['form_data']['id'], 'class' => 'filter_form_validation', 'url' => $data['form_data']['action'], 'method' => $data['form_data']['method']]) !!}
    
                            <div class="form-group{{ $errors->has('address') ? 'has-error' : '' }}">                                
                                <div class="{{ $data['form_data']['class']['input_cnt'] }}">
                                    <input id="address" type="text" class="{{ $data['form_data']['class']['input'] }}" name="address" value="{{ !empty($data['form_data']['request_field']) ? $data['form_data']['request_field']->address : null }}" >   
                                </div>
                            </div>

                            <div class="hidden form-group{{ $errors->has('lat') ? ' has-error' : '' }}">
                                <div class="col-md-9">
                                    <input id="lat" type="hidden" class="form-control" name="lat" value="{{ !empty($data['form_data']['request_field']) ? $data['form_data']['request_field']->lat : null }}" >
                                </div>
                            </div>

                            <div class="hidden form-group{{ $errors->has('lng') ? ' has-error' : '' }}">
                                <div class="col-md-9">
                                    <input id="lng" type="hidden" class="form-control" name="lng" value="{{ !empty($data['form_data']['request_field']) ? $data['form_data']['request_field']->lng : null }}" >
                                </div>
                            </div>                            

                            <div class="filter_cnt">

                                <div class="input_wrapper">

                                    <div class="flex_input_cnt">
    
                                        <div class="form-group flex_input{{ $errors->has('beds_number') ? 'has-error' : '' }}">                                    
                                            <div class="">
                                                <input id="beds_number" type="number" class="{{ $data['form_data']['class']['input'] }}" name="beds_number" value="{{ !empty($data['form_data']['request_field']) ? $data['form_data']['request_field']->beds_number : null }}" placeholder="Quanti posti letto">   
                                            </div>
                                        </div>
                                    
                                        <div class="form-group flex_input{{ $errors->has('bathrooms_number') ? 'has-error' : '' }}">                                    
                                            <div class="">
                                                <input id="bathrooms_number" type="number" class="{{ $data['form_data']['class']['input'] }}" name="bathrooms_number" value="{{ !empty($data['form_data']['request_field']) ? $data['form_data']['request_field']->bathrooms_number : null }}" placeholder="Quanti bagni">   
                                            </div>
                                        </div>
    
                                    </div>
                                
                                    <div class="form-group{{ $errors->has('distance') ? 'has-error' : '' }}">                                    
                                        <div class="{{ $data['form_data']['class']['input_cnt'] }}">
                                            <input id="distance" type="number" class="{{ $data['form_data']['class']['input'] }}" name="distance" value="{{ !empty($data['form_data']['request_field']) ? $data['form_data']['request_field']->distance : null }}" placeholder="Raggio di ricerca in Km">   
                                        </div>
                                    </div>
                                </div>
                                
                            
                                <div class="form-group checkbox_list_cnt{{ $errors->has('features') ? ' has-error' : '' }}">
                                    <ul class="checkbox_list">
                                        @foreach($data['form_data']['chek_notcheck_feat'] as $feat) 
                                            <li class="checkbox_item_cnt">
                                                <label class="checkbox_item" for="{{ $feat['name'] }}">{{ $feat['name'] }}
                                                    <input class="custom_checkbox" type="checkbox" name="features[]" id="{{ $feat['name'] }}" {{ $feat['isChecked'] ? 'checked' : null}}>
                                                    <span class="checkmark"></span>
                                                </label>
                                                {{-- <input type="checkbox" class="custom_checkbox{{ $data['form_data']['class']['check_input'] }}" name="features[]" id="{{ $feat['name'] }}" value="{{ $feat['id'] }}" {{ $feat['isChecked'] ? 'checked' : null}} autofocus> 
                                                <label class="{{ $data['form_data']['class']['check_label'] }}" for="{{ $feat['name'] }}">{{ $feat['name'] }}</label> --}}
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
                                
                            


                        {!! Form::close() !!}                   
                    </div>
                </div>
            </div>

            <div class="row bottom_cnt">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt iure impedit placeat accusamus quo. Sequi, pariatur suscipit in architecto, nulla cumque sit perferendis voluptas soluta dolorum quia, tempora illo voluptatum. Aperiam iste odit facere in pariatur, architecto quod qui hic alias neque magnam culpa, corporis maxime quaerat adipisci distinctio rem similique nam est ipsa animi sit quo. Accusantium, a ducimus odit dicta, numquam architecto cupiditate dignissimos dolorum quisquam enim voluptatum! Inventore, doloribus aspernatur! Nam quam quidem odio, ducimus enim nesciunt et maiores pariatur explicabo delectus officia reprehenderit quia, odit ex repellendus molestiae laborum nostrum praesentium doloribus nisi. Iste culpa voluptas itaque, vero veniam id error ratione, ex minima ab quam. Magni, nostrum dolores. Necessitatibus, laboriosam tempora ex temporibus dolorum dicta numquam molestias, saepe assumenda cupiditate provident amet expedita voluptate. Soluta culpa a quaerat illum ea sint natus ducimus magni esse, assumenda ullam sequi voluptas dolorum labore numquam fuga voluptates nulla inventore voluptate autem, earum iste debitis! Mollitia odio est eos! Distinctio, delectus debitis. Exercitationem maiores quia officiis aliquid impedit, neque id ad debitis omnis. Aut, dignissimos illum. Doloremque nam soluta quasi nisi eveniet nulla magni quis aliquam vel modi. Minus unde aliquam vitae distinctio deleniti? Porro quia laborum at ullam consequatur tempora error dolores! Aut asperiores soluta corporis optio perspiciatis incidunt quae unde dolor ab. Veniam laborum ullam fugiat nihil ad animi asperiores cumque suscipit quia molestias fugit dolor provident vero voluptates, officia dicta quam cum cupiditate temporibus reprehenderit perferendis porro similique? Totam, eveniet aut. Architecto nostrum temporibus fugiat voluptatum deleniti maiores. Pariatur, distinctio! Neque, consequuntur optio fuga velit amet omnis. Error, consectetur. Facere illum, maxime ullam eum incidunt repudiandae. Quasi asperiores eos nihil placeat fuga perferendis tempora esse quis numquam. Nesciunt dolore accusantium itaque perspiciatis vero maxime voluptas, totam obcaecati numquam, odio quod illum? Nesciunt porro inventore incidunt aliquam pariatur veniam atque quasi nostrum voluptate et cupiditate, laudantium blanditiis velit, provident vel consectetur fugiat iure id soluta amet sint nisi quas odit autem. Delectus, autem. Ad quia voluptas qui necessitatibus ducimus, corporis iure? Sit nisi vitae voluptatum commodi inventore dicta impedit minus corporis velit alias dolorem excepturi labore, deleniti consectetur itaque suscipit non. Delectus architecto cum perspiciatis tempora, aliquam itaque dolores reiciendis ad eveniet porro nihil exercitationem tenetur rem eos provident facere aut! Delectus sequi officia, labore unde sapiente aspernatur blanditiis perferendis ut, temporibus vitae consectetur laudantium animi magnam omnis illum id voluptatum culpa quasi quia doloremque quo maxime architecto saepe! Nisi quo id earum eos sequi rem incidunt. Alias atque labore dolores eaque iste, quae eligendi neque tempore vero saepe. Optio ad, dolore animi ipsum hic quo, consectetur nihil nemo quam adipisci velit officia. Dolore at voluptatum architecto quos enim harum dolorum minus voluptas incidunt? Vel architecto nulla animi nobis maxime quisquam sapiente enim quidem? Odio nihil maiores, ut distinctio hic sit numquam mollitia asperiores, enim similique maxime temporibus rerum natus praesentium eos dolores a quam eum exercitationem! Libero sequi doloribus ratione ea porro exercitationem quidem magnam quae amet perferendis harum ut qui obcaecati nisi, atque a omnis!
            </div>
        </div>

        

        
        {{-- <div class="flex-center position-ref full-height">
   
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('home') }}">{{ Auth::user()->name }} </a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="container content">
                <div class="row">

                    <div class="title col-md-12">
                        BoolBnb
                    </div>

                    <div class="form_cnt col-md-6">
                        @include('components.search_form')                    
                    </div>
                    
                    <div id="sponsored_apart" class="col-md-6">

                    </div>
                    
                </div>
               
            </div>
        </div> --}}
    </body>
    <script>
        $(document).ready(function() {
            $("#address").geocomplete({ 
                details: "#apartment_search_form" 
            });
        });        
    </script>
</html>
