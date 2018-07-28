@extends('layouts.app')
    <script src=" {{ config('external_api.google_maps.base_path') }}&amp;key={{ config('external_api.google_maps.api_key') }}"></script>
@section('content')

    {{-- <div id="ajax_spinner hide">
        <div class="fa-5x" >
            <i class="fas fa-spinner fa-spin"></i>
        </div>
    </div> --}}

    <div class="container">
        <div class="row">
            @if( !(empty($apartmentsToShow)) )
                
                <h1 class="">Appartamenti vicino a: {{ $address_searched }} </h1>    
                
                <div class="col-md-2 filters-cnt">
                    
                    {{-- {{ dd($request_field) }}  --}}   

                    <form id="re_search" class="form-horizontal" method="GET" action="{{ route('apartments.results') }}">           
                        
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-12 control-label text-left">Indirizzo</label>
                            <div class="col-md-12">
                                <input id="address" type="text" class="form-control col-xs-12" name="address" value="{{ $request_field->address }}" required autofocus>   
                            </div>
                        </div>

                        <div class="hidden form-group{{ $errors->has('lat') ? ' has-error' : '' }}">
                            <div class="col-md-9">
                                <input id="lat" type="hidden" class="form-control" name="lat" value="{{ $request_field->lat }}" >
                            </div>
                        </div>

                        <div class="hidden form-group{{ $errors->has('lng') ? ' has-error' : '' }}">
                            <div class="col-md-9">
                                <input id="lng" type="hidden" class="form-control" name="lng" value="{{ $request_field->lng }}" >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('beds_number') ? ' has-error' : '' }}">
                            <label for="beds_number" class="col-md-12 control-label text-left">Posti letto</label>
                            <div class="col-md-12">
                                <input id="beds_number" type="number" class="form-control col-xs-12" name="beds_number" value="{{ $request_field->beds_number }}">   
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('bathrooms_number') ? ' has-error' : '' }}">
                            <label for="bathrooms_number" class="col-md-12 control-label text-left">Numero bagni</label>
                            <div class="col-md-12">
                                <input id="bathrooms_number" type="number" class="form-control col-xs-12" name="bathrooms_number" value="{{ $request_field->bathrooms_number }}">   
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('distance') ? ' has-error' : '' }}">
                            <label for="distance" class="col-md-12 control-label text-left">Cerca nel raggio di Km...</label>
                            <div class="col-md-12">
                                <input id="distance" type="number" class="form-control col-xs-12" name="distance" value="{{ $request_field->distance }}">   
                            </div>
                        </div>

                        @foreach($chek_notcheck_feat as $feat)
                                    <label class="col-md-8" for="{{ $feat['name'] }}">{{ $feat['name'] }}</label>
                                    <input type="checkbox" class="col-md-4" name="features[]" id="{{ $feat['name'] }}" value="{{ $feat['id'] }}" {{ $feat['isChecked'] ? 'checked' : null}} autofocus> 
                                @endforeach 
                        
                        <div class="form-group">
                            <div class="col-md-10 ">
                                <input id="send_ajax_call" type="submit" class="btn btn-primary" value="Cerca">
                            </div>
                        </div>   
                    </form>  


                </div>
                <div class="col-md-10 results-cnt">
                    @include('components.apartments_cards')
                </div>

            @else

                <h1> Non sono stati trovati appartamenti in questa zona </h1>        
                <h3> {{ $address_searched }} </h3> 
                <a href=" {{ route('welcome') }} " class="btn btn-primary" role="button">Cerca in un' altra zona</a>
            @endif                 
        </div>       
    </div>

    
    {{-- {{ dd($apartmentsToShow) }} --}}
@endsection

@section('additional-scripts')
    
    <script type="text/javascript">
        
        $(document).ready(function() {

            $("#address").geocomplete({ 
                details: "#re_search"; 
            });

            $('#re_search').on('submit', function(event) {
                event.preventDefault();

                var formData = new FormData();

                console.log($('#beds_number').val());
                
                /* formData.append('bedsnumber', '4');
                for (var key of formData.entries()) {
                    console.log(key[0] + ', ' + key[1]);
                } */
                
                
                /* $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
                    var token;
                    if (!options.crossDomain) {
                        token = $('meta[name="csrf-token"]').attr('content');
                        if (token) {
                        return jqXHR.setRequestHeader('X-CSRF-Token', token);
                        }
                    }
                });
                */ 
                var myCheckboxes = new Array();
                var features = new Array(); 
                $("input:checked").each(function() {
                    features.push($(this).val());
                });

                $.ajax({
                    url: $('#re_search').attr('action'),
                    method : "GET", 
                    data : {
                        "address" : $('#address').val(),
                        "lat" : $('#lat').val(),
                        "lng" : $('#lng').val(),
                        "beds_number" : $('#beds_number').val(),
                        "bathrooms_number" : $('#bathrooms_number').val(),
                        "distance" : $('#distance').val(),
                        "features[]" : features
                    },
                    beforeSend:function() {
                        $('body').css('backgroundColor', 'red');                        
                    },          
                    success:function(data, stato) {
                        console.log( data.html );
                        $('body').css('background', 'transparent');

                        $('.results-cnt').html(data.html);
                    },
                    error:function(richiesta,stato,errori) {
                        alert( "E' avvenuto un errore. ");
                    }
                });
                                
            });

            /* $('#send_ajax_call').click(function() {
                $ .ajax({
                    url: '/apartments-results',
                    method : "GET",                    
                    success:function(data, stato) {
                        console.log(data);
                    },
                    error:function(richiesta,stato,errori) {
                        alert( "E' avvenuto un errore. ");
                    }
                });                
            }); */
        });

    </script>    
@endsection