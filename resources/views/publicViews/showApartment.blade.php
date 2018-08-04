@extends('layouts.app')
    
@section('content')
    <div class="wrapper">

        <div class="container-fluid gallery-wrapper">
            <div class="row">
                <div class="gallery_cnt col-xs-12">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->     
                        <ol class="carousel-indicators">
                            @foreach($images as $image)
                                <li data-target="#carousel-example-generic" data-slide-to="{{ $loop->iteration }}" class="{{ ($loop->iteration == 1) ? 'active' : null}}"></li>
                            @endforeach 
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            @foreach($images as $image)                                    
                                <div class="item {{ ($loop->iteration == 1) ? 'active' : null}}">
                                    <img class="img-responsive" src="{{ asset('storage/'.$image) }}" alt="the image is not available">
                                </div>
                            @endforeach    
                        </div>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
      
        <div class="container">
            <div class="row">
                <div class="detail_cnt col-xs-12">
                    <div class="detail_cnt_left {{ ($user_logged_id == $apartment->user_id) ? "col-md-6" : "col-xs-12 col-md-6" }}"> 
                        <div class="info_cnt">
                            <h1 class="title info_values">{{$apartment->title}}</h1>      
                        </div>
                        <div class="info_cnt address_cnt">
                            <div class="info_type">Indirizzo: </div>
                            <div class="address info_values">{{$apartment->address}}</div>      
                        </div>
                        <div class="features_cnt">
                            <div class="info_cnt">
                                <div class="icons_field"><i class="fas fa-bed"></i></div>
                                <div class="info_type">Posti letto: </div>
                                <div class="beds_number info_values">{{$apartment->beds_number}}</div>      
                            </div>
                            <div class="info_cnt">
                                <div class="icons_field"><i class="fas fa-shower"></i></div>
                                <div class="info_type">Bagni: </div>
                                <div class="bathrooms_number info_values">{{$apartment->bathrooms_number}}</div>      
                            </div>
                            <div class="info_cnt">
                                <div class="icons_field"><i class="fas fa-home"></i></div>
                                <div class="info_type">Superficie: </div>
                                <div class="area info_values">{{$apartment->area}} mq.</div>      
                            </div>
                            <div class="info_cnt">
                                <div class="icons_field"><i class="fas fa-money-bill-alt"></i></div>
                                <div class="info_type">Prezzo/notte: </div>
                                <div class="price info_values">{{$apartment->price}} €</div>      
                            </div>
                        </div>
                        <div class="info_cnt services">
                            <span class="info_type">Servizi: </span>
                            <ul class="features-list">
                                @foreach($features as $feature)
                                    <li class="feature">
                                        <span>{{$feature->name}}</span>
                                    </li>
                                @endforeach    
                            </ul>               
                        </div>
                    </div>
                    {{-- Form to send message --}}
                    <div class="send_message_cnt col-xs-12 col-md-6">
                        <form class="{{ ($user_logged_id == $apartment->user_id) ? "disabled" : null }}" id="send_message_form" action="{{route('message.send', $apartment->id)}}" method="post">
                            {{ csrf_field() }}
    
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-12 control-label text-left pl-0">Nome</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control col-xs-12" name="name" value="{{ !(Auth::guest()) ? Auth::user()->name : null }}" {{ ($user_logged_id == $apartment->user_id) ? "disabled" : null }} placeholder="Insert your name">   
                                </div>
                            </div>
    
                            <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                                <label for="surname" class="col-md-12 control-label text-left pl-0">Cognome</label>
                                <div class="col-md-12">
                                    <input id="surname" type="text" class="form-control col-xs-12" name="surname" value="{{ !(Auth::guest()) ? Auth::user()->surname : null }}" {{ ($user_logged_id == $apartment->user_id) ? "disabled" : null }} placeholder="Insert your surname">   
                                </div>
                            </div>
        
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-12 control-label text-left pl-0">e-mail</label>
                                <div class="col-md-12">
                                    <input id="email" type="text" class="form-control col-xs-12" name="email" value="{{ !(Auth::guest()) ? Auth::user()->email : null }}" {{ ($user_logged_id == $apartment->user_id) ? "disabled" : null }} placeholder="Insert your email">   
                                </div>
                            </div>
        
                            <div class="form-group{{ $errors->has('message_content') ? ' has-error' : '' }}">
                                <label for="message_content" class="col-md-12 control-label text-left">Messaggio</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="message_content" type="text" id="message_content" cols="30" rows="8" {{ ($user_logged_id == $apartment->user_id) ? "disabled" : null }} placeholder="Invia un messaggio al proprietario"></textarea>  
                                    @if ($errors->has('message_content'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('message_content') }}</strong>
                                        </span>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" {{ ($user_logged_id == $apartment->user_id) ? "disabled" : null }} class="form-control col-xs-12 btn custom_button_invert btn_no_border" value="Invia">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid map_wrapper">
            <div class="row">
                <div class="map_cnt col-xs-12">
                    <div id="map"></div>                 
                </div>
            </div>
        </div> 
    </div>
@endsection

@section('additional-scripts')

    <script>
      var map;
      function initMap() {
        map_point = {
            lat: parseFloat('{{$apartment->latitude}}'),
            lng: parseFloat('{{$apartment->longitude}}')
        };
        map = new google.maps.Map(document.getElementById('map'), {
            center: map_point,
            zoom: 13
        });
        var marker = new google.maps.Marker({position: map_point, map: map});
      }
    </script>
    <script src=" {{ config('external_api.google_maps.base_path') }}&amp;key={{ config('external_api.google_maps.api_key') }}&amp;callback=initMap" async defer></script>
    

@endsection