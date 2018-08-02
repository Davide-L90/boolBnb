<a href="{{route('apartments.detail', $apartment['apartment']['id'])}}" class="thumbnail apartment_card">
    <div class="img_cnt">
        <img src="{{ asset('storage/'.$apartment['thumbnail']) }}" alt="...">
    </div>
    <div class="caption info_section">
        <p class="apartment_title"> {{ $apartment['apartment']['title'] }} </p>
        <p class="apartment_price"> {{ $apartment['apartment']['price'] }} &euro;/mese </p>
        @if($apartment['distance'] < 0)
            <p class="apartment_distance hidden"> </p>
        @else      
            <p class="apartment_distance"> {{ ( ($apartment['distance'] > 0) && ($apartment['distance'] < 1) ) ? (number_format(($apartment['distance'] * 1000), 0)).' m' : (number_format($apartment['distance'], 1)).' km' }} </p>  
        @endif
    </div>
</a>
   