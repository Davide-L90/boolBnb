@extends('layouts.app')
    
@section('content')
    <div class="container">
        <div class="row">

            <div class="detail_cnt">
                <div class="detail_cnt_left col-xs-12">
                    <div class="gallery_cnt col-md-6">
                        gallery
        
                    </div>
                    
                    <div class="features_cnt col-md-6">
                        <div class="info_cnt">
                            <h1 class="title">{{$apartment->title}}</h1>      
                        </div>
                        <div class="info_cnt">
                            <p class="info_type">Indirizzo: </p>
                            <p class="address">{{$apartment->address}}</p>      
                        </div>
                        <div class="info_cnt">
                            <p class="info_type">Posti letto: </p>
                            <p class="beds_number">{{$apartment->beds_number}}</p>      
                        </div>
                        <div class="info_cnt">
                            <p class="info_type">Bagni: </p>
                            <p class="bathrooms_number">{{$apartment->bathrooms}}</p>      
                        </div>
                        <div class="info_cnt">
                            <p class="info_type">Superficie: </p>
                            <p class="area">{{$apartment->area}} mq.</p>      
                        </div>
                        <div class="info_cnt">
                            <p class="info_type">Prezzo: </p>
                            <p class="price">{{$apartment->price}}</p>      
                        </div>
                        <div class="info_cnt">
                            <p class="info_type">Servizi aggiuntivi: </p>
                            <ul class="features-list">
                                @foreach($features as $feature)
                                    <li class="feature">
                                        <p>{{$feature->name}}</p>
                                    </li>
                                @endforeach    
                            </ul>    
                                 
                        </div>
        
        
            
                    </div>
                </div>
                <div class="detail_cnt_right col-xs-12">

                    <div class="map_cnt col-md-6">
                        <div id="map"></div>
                    </div>

                    {{-- Form to send message --}}
                    <div class="send_message_cnt col-md-6">

                        <form id="send_message_form" action="{{route('message.send', $apartment->id)}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-12 control-label text-left pl-0">Nome</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control col-xs-12" name="name" value="{{ !(Auth::guest()) ? Auth::user()->name : null }}" placeholder="Insert your name">   
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                                <label for="surname" class="col-md-12 control-label text-left pl-0">Cognome</label>
                                <div class="col-md-12">
                                    <input id="surname" type="text" class="form-control col-xs-12" name="surname" value="{{ !(Auth::guest()) ? Auth::user()->surname : null }}" placeholder="Insert your surname">   
                                </div>
                            </div>
        
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-12 control-label text-left pl-0">e-mail</label>
                                <div class="col-md-12">
                                    <input id="email" type="text" class="form-control col-xs-12" name="email" value="{{ !(Auth::guest()) ? Auth::user()->email : null }}" placeholder="Insert your email">   
                                </div>
                            </div>
        
                            <div class="form-group{{ $errors->has('message_content') ? ' has-error' : '' }}">
                                <label for="message_content" class="col-md-12 control-label text-left">Messaggio</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="message_content" type="text" id="message_content" cols="30" rows="8" placeholder="Invia un messaggio al proprietario"></textarea>  
                                    @if ($errors->has('message_content'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('message_content') }}</strong>
                                        </span>
                                     @endif
                                </div>
                            </div>
        
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" class="form-control col-xs-12 btn btn-primary" value="Invia">
                                </div>
                            </div>
                            
                        </form>
                    </div>
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