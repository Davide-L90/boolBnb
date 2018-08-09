@extends('layouts.app')
    
@section('content')

    <div class="container-fluid">
        <div class="row finder_view">
            
            @if( !(empty($apartmentsToShow)) )
                
                <h1 id="search_title">Appartamenti vicino a: <span id="address_searched">{{ $address_searched }}</span> </h1>    
                
                <div class="col-md-3 filters-cnt">
                   <form action="{{ route('apartments.results') }}" id="form_search_ajax" class="form-horizontal filter_form_validation" method="GET">
                        <div class="field_cnt form-group{{ $errors->has('address') ? 'has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="address" type="text" class="col-xs-12" name="address" value="{{$request->address }}" placeholder="Indirizzo">   
                            </div>
                        </div>
                    
                        <div class="field_cnt hidden form-group{{ $errors->has('lat') ? ' has-error' : '' }}">
                            <div class="col-md-9">
                                <input id="lat" type="hidden" class="" name="lat" value="{{ $request->lat }}" >
                            </div>
                        </div>
                    
                        <div class="field_cnt hidden form-group{{ $errors->has('lng') ? ' has-error' : '' }}">
                            <div class="col-md-9">
                                <input id="lng" type="hidden" class="" name="lng" value="{{ $request->lng }}" >
                            </div>
                        </div>
                    
                        <div class="filter_cnt">
                            
                            <div class="field_cnt form-group{{ $errors->has('beds_number') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <input id="beds_number" type="text" class="col-xs-12" name="beds_number" value="{{ !empty($request) ? $request->beds_number : null }}" placeholder="Numero letti">   
                                </div>
                            </div>
                        
                            <div class="field_cnt form-group{{ $errors->has('bathrooms_number') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <input id="bathrooms_number" type="text" class="col-xs-12" name="bathrooms_number" value="{{ !empty($request) ? $request->bathrooms_number : null }}" placeholder="Numero bagni">   
                                </div>
                            </div>
                        
                            <div class="field_cnt form-group{{ $errors->has('distance') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <input id="distance" type="text" class="col-xs-12" name="distance" value="{{ !empty($request) ? $request->distance : null }}" placeholder="Distanza">   
                                </div>
                            </div>
                        
                            <div class="col-md-12 field_cnt form-group{{ $errors->has('features') ? ' has-error' : '' }}">
                                <ul class="features_list">
                                    @foreach($check_notcheck_feat as $feat)
                                        <li>
                                            <input type="checkbox" class="" name="features[]" id="{{ $feat['name'] }}" value="{{ $feat['id'] }}" {{ $feat['isChecked'] ? 'checked' : null}} autofocus> 
                                            <label class="features_name" for="{{ $feat['name'] }}">{{ $feat['name'] }}</label>
                                        </li> 
                                    @endforeach
                                </ul>
                            </div>    
                        
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn custom_button large">
                                        Filtra Risultati
                                    </button>
                                </div>
                            </div> 
                        </div>
                    </form>
                </div>

                <div class="col-md-9 results-cnt">
                    @if (!empty($apartmentsToShow[0]['apartment']))
                           
                        @include('components.apartments_cards')

                    @endif
                </div>

                @else
                    <div id="not_found_msg_cnt">
                        <h1> Non sono stati trovati appartamenti in questa zona: </h1>        
                        <h3> {{ $address_searched }} </h3> 
                        <a href=" {{ route('welcome') }} " class="btn custom_button_invert" role="button">Cerca in un'altra zona</a>
                    </div>
                @endif

            </div>       
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
            
        });

    </script>    
@endsection