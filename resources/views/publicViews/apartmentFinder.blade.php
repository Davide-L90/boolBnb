@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            @if( !(empty($apartmentsToShow)) )
                
                <h1 class="">Appartamenti vicino a: {{ $address_searched }} </h1>    
                
                <div class="col-md-2 filters-cnt">
                        
                    <form id="re_search" class="form-horizontal" method="GET" action="{{ route('apartments.results') }}">
                        {{ csrf_field() }}
                        {{ method_field('GET') }}                        

                        <div class="form-group{{ $errors->has('beds_number') ? 'has-error' : '' }}">
                            <label for="beds_number" class="col-md-12 control-label text-left">Stanze</label>
                            <div class="col-md-12">
                                <input id="beds_number" type="number" class="form-control col-xs-12" name="beds_number" value="{{ $request_field->beds_number }}" required autofocus>   
                            </div>
                        </div>
                        
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
                <a href=" {{ route('welcome') }} " class="btn btn-primary" role="button">Cerca in un\'altra zona</a>
            @endif        
                    
        </div>
    </div>
    {{-- {{ dd($apartmentsToShow) }} --}}
@endsection

@section('additional-scripts')
    
    <script type="text/javascript">
        
        $(document).ready(function() {

            $('#re_search').on('submit', function(event) {
                event.preventDefault();

                var formData = new FormData();

                console.log($('#beds_number').val());
                
                formData.append('bedsnumber', '4');
                for (var key of formData.entries()) {
                    console.log(key[0] + ', ' + key[1]);
                }
                
                
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
                $.ajax({
                    url: $('#re_search').attr('action'),
                    method : "GET", 
                    data : {
                        "beds_number" : $('#beds_number').val()
                    },
                    beforeSend:function() {
                        $('body').css('backgroundColor', 'red');
                        console.log('ciao');
                        
                    },          
                    success:function(data, stato) {
                        console.log(data);
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