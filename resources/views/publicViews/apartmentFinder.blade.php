@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            @if( !(empty($apartmentsToShow)) )
                
                <h1 class="">Appartamenti vicino a: {{ $address_searched }} </h1>    
                
                @foreach($apartmentsToShow as $apartment)
                
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                        <img src="https://www.orogel.it/media/immagini/190_z_carote_e_vitaminaA.jpg" alt="...">
                        <div class="caption">
                            <h3> {{ $apartment['apartment']['title'] }} </h3>
                            <p> {{ $apartment['apartment']['price'] }} &euro;/mese </p>
                            <p> {{ ($apartment['distance'] < 1) ? (number_format(($apartment['distance'] * 1000), 0)).' m' : (number_format($apartment['distance'], 1)).' km' }} </p>
                            <p><a href="#" class="btn btn-primary" role="button">Visualizza Dettagli</a></p>
                        </div>
                        </div>
                    </div>
                @endforeach

            @else

                <h1> Non sono stati trovati appartamenti in questa zona </h1>        
                <h3> {{ $address_searched }} </h3> 
                <a href=" {{ route('welcome') }} " class="btn btn-primary" role="button">Cerca in un\'altra zona</a>
            @endif        
                    
        </div>
    </div>
    {{-- {{ dd($apartmentsToShow) }} --}}
@endsection