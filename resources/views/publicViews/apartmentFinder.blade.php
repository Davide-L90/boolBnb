@extends('layouts.app')
    
@section('content')

    {{-- <div id="ajax_spinner hide">
        <div class="fa-5x" >
            <i class="fas fa-spinner fa-spin"></i>
        </div>
    </div> --}}

    <div class="container-fluid">
        <div class="row">
            
            @if( !(empty($apartmentsToShow)) )
                
                <h1 class="">Appartamenti vicino a: <span id="address_searched">{{ $address_searched }}</span> </h1>    
                
                <div class="col-md-3 filters-cnt">
                   
                    @include('components.search_form')

                </div>

                <div class="col-md-9 results-cnt">
                    @foreach($apartmentsToShow as $apartment)
                        
                            @include('components.apartments_cards')
                        
                    @endforeach
                </div>

            @else

                <h1> Non sono stati trovati appartamenti in questa zona </h1>        
                <h3> {{ $address_searched }} </h3> 
                <a href=" {{ route('welcome') }} " class="btn btn-primary" role="button">Cerca in un'altra zona</a>
            
            @endif        
                    
        </div>       

    </div>

    
    {{-- {{ dd($apartmentsToShow) }} --}}
@endsection

@section('additional-scripts')
    
    <script type="text/javascript">
        
        $(document).ready(function() {

            $("#address").geocomplete({ 
                details: "#form_search_ajax" 
            });

            $('#form_search_ajax').on('submit', function(event) {
                event.preventDefault();
                
                /* 
                    Get input value of address field and change the address showed 
                    in h1 tag on top of the page
                */
                var address_input = $('#address').val();
                $('#address_searched').text(address_input);
                
                /*
                    features array will contain all checked features
                    to send with the get request
                */
                var features = new Array();                 
                $("input:checked").each(function() {
                    features.push($(this).val());
                });

                /* 
                    form validation. AJAX call will be send only if
                    all form fields are correct
                */

                var address_field = $('#address');
                var address_value = address_field.val();
        
                var beds_field = $('#beds_number');
                var beds_value = beds_field.val();
        
                var bathrooms_field = $('#bathrooms_number');
                var bathrooms_value = bathrooms_field.val();
        
                var distance_field = $('#distance');
                var distance_value = distance_field.val();
                
                var canSubmit = true;

                errorReset();
            
                if ( address_value.length == 0 ) {
                    showError(address_field, 'E\' necessario inserire l\'indirizzo');
                    canSubmit = false;            
                }

                if (beds_value.length != 0 && beds_value <= 0 ) {
                    showError(beds_field, 'Il numero di posti letto inserito deve essere maggiore o uguale a 0');
                    canSubmit = false;
                }


                if (bathrooms_value.length != 0 && beds_value.length != 0) {
                    if (bathrooms_value > beds_value) {
                        showError(bathrooms_field, 'Il numero di bagni inserito deve essere minore dei posti letto richiesti');
                        canSubmit = false;
                    } 
                }
                
                if (bathrooms_value.length != 0 && bathrooms_value <= 0) {
                    showError(bathrooms_field, 'Il numero di bagni inserito deve essere maggiore o uguale a 0');
                    canSubmit = false;
                }

                if (distance_value.length != 0 && distance_value <= 0) {
                    showError(distance_field, 'Inserire un numero positivo');
                    canSubmit = false;
                }

                if (canSubmit) {
                    
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
                            console.log('ciao');
                            
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
                }
                                
            });        
        
            function showError(field_obj, message) {
                field_obj.parents('.form-group').addClass('has-error');
                field_obj.parent().append(
                    '<span class="help-block">' + 
                        '<strong class="error_showed">' + message + '</strong>' + 
                    '</span>'
                );        
            }

            function errorReset() {
                $('.help-block').remove();
                $('.form-group').removeClass('has-error');
            }
        });

    </script>    
@endsection