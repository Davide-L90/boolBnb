@extends('layouts.app')
    
@section('content')

    {{-- <div id="ajax_spinner hide">
        <div class="fa-5x" >
            <i class="fas fa-spinner fa-spin"></i>
        </div>
    </div> --}}

    <div class="container">
        <div class="row">
            
            @if( !(empty($apartmentsToShow)) )
                
                <h1 class="">Appartamenti vicino a: <span id="address_searched">{{ $address_searched }}</span> </h1>    
                
                <div class="col-md-2 filters-cnt">
                   
                    @include('components.search_form')

                </div>

                <div class="col-md-10 results-cnt">
                
                    @include('components.apartments_cards')
                
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
                details: "#re_search" 
            });

            $('#re_search').on('submit', function(event) {
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
                                
            });
        });

    </script>    
@endsection