@foreach($apartmentsToShow as $apartment)
                    
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
        <img src="https://www.orogel.it/media/immagini/190_z_carote_e_vitaminaA.jpg" alt="...">
        <div class="caption">
            <h3> {{ $apartment['apartment']['title'] }} </h3>
            <p> {{ $apartment['apartment']['price'] }} &euro;/mese </p>
            <p> {{ ($apartment['distance'] < 1) ? (number_format(($apartment['distance'] * 1000), 0)).' m' : (number_format($apartment['distance'], 1)).' km' }} </p>
            <p><a href="{{route('apartments.detail', $apartment['apartment']['id'])}}" class="btn btn-primary" role="button">Visualizza Dettagli</a></p>
        </div>
        </div>
    </div>
                        
@endforeach