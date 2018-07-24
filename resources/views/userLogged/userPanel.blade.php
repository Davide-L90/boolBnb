@extends('layouts.app')
<script src=" {{ config('external_api.google_maps.base_path') }}&key={{ config('external_api.google_maps.api_key') }}"></script>

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">                
                <div class="panel-heading">
                    Your Apartment
                    <div class="apartments-list-cnt" >
                        {{-- Apartments list --}}
                        @if(!empty($apartments))
                            @foreach($apartments as $apartment)
                                <div class="card {{ $apartment->is_active ? '' : 'disabled-card' }}" style="width: 18rem;">
                                    <img class="img-responsive thumbnail {{ $apartment->is_active ? '' : 'disabled-img' }} " src="https://www.orogel.it/media/immagini/190_z_carote_e_vitaminaA.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $apartment->title }}</h5>
                                        <a href=" {{ route('ownerApartmentDetails', $apartment->id) }} " class="btn btn-primary">Visualizza dettagli</a>
                                        <a class="btn btn-danger delete-id" data-route-delete=" {{ route('apartaments.destroy', $apartment->id) }} " href="#">Elimina</a> 
                                        <form class="pizza" action="{{ route('apartaments.update', $apartment->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input type="hidden" name="isActive" value="{{ $apartment->is_active ? 1 : 0 }}" class="secret">    
                                            <input type="submit" value="{{ $apartment->is_active ? 'Disattiva annuncio' : 'Attiva annuncio' }}" class="switch btn btn-warning">
                                        </form>
                                    </div>
                                </div>   
                            @endforeach
                        @endif
                
                        <div class="panel-body">
                            <button id="addApartment">+</button>
                        </div>
                    </div>
                </div>                
            </div>      
        </div>    
    </div>

{{-- Popup window to confirm delete an apartment --}}
<div class="hidden delete-popup" apartment_id="">
    <h2>Sei sicuro di voler eliminare questo Appartamento?</h2>
    <form id="delete_form" action="" data-delete-id="" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input id="yes" class="btn btn-danger delete-btn" type="submit" value="Si">
    </form>
    <a id="no" class="btn btn-primary">No</a>
{{-- {{ route('apartaments.destroy', $apartment->id) }} --}}
</div>

{{-- Hidden form for add an apartment --}}
<div class="container apartments-add-form">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">                
                <div class="panel-heading">Add Apartments detail</div>
                    
                <div class="panel-body">                        
                    <form id="apartment_register_form" class="form-horizontal" method="POST" action=" {{ route('apartaments.store') }} ">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">Title</label>

                            <div class="col-md-9">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <div class="form-group{{ $errors->has('beds_number') ? ' has-error' : '' }}">
                            <label for="beds_number" class="col-md-2 control-label">Numero stanze</label>

                            <div class="col-md-9">
                                <input id="beds_number" type="text" class="form-control" name="beds_number" value="{{ old('beds_number') }}" required autofocus>
                                @if ($errors->has('beds_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('beds_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('bathrooms_number') ? ' has-error' : '' }}">
                            <label for="bathrooms_number" class="col-md-2 control-label">Numero bagni</label>

                            <div class="col-md-9">
                                <input id="bathrooms_number" type="text" class="form-control" name="bathrooms_number" value="{{ old('bathrooms_number') }}" required autofocus>
                                @if ($errors->has('bathrooms_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bathrooms_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                            <label for="area" class="col-md-2 control-label">Metri quadrati</label>

                            <div class="col-md-9">
                                <input id="area" type="text" class="form-control" name="area" value="{{ old('area') }}" required autofocus>
                                @if ($errors->has('area'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-2 control-label">Prezzo</label>

                            <div class="col-md-9">
                                <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}" required autofocus>
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-2 control-label">Indirizzo</label>

                            <div class="col-md-9">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="hidden form-group{{ $errors->has('lat') ? ' has-error' : '' }}">
                            <div class="col-md-9">
                                <input id="lat" type="text" class="form-control" name="lat" value="{{ old('lat') }}" >
                            </div>
                        </div>

                        <div class="hidden form-group{{ $errors->has('lng') ? ' has-error' : '' }}">
                            <div class="col-md-9">
                                <input id="lng" type="text" class="form-control" name="lng" value="{{ old('lng') }}" >
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('features') ? ' has-error' : '' }}">
                            <label for="features" class="col-md-2 control-label">Servizi Aggiuntivi</label>

                            <div class="col-md-9">
                                @foreach($features as $feature)
                                    <label class="col-md-8" for="{{ $feature['name'] }}">{{ $feature['name'] }}</label>
                                    <input type="checkbox" class="col-md-4" name="features[]" id="{{ $feature['name'] }}" value="{{ $feature['id'] }}" autofocus> 
                                @endforeach
                                
                                @if ($errors->has('features'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('features') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
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
        $(document).ready(function() {
            $("#address").geocomplete({ 
                details: "#apartment_register_form" 
            });
        })
</script>

@endsection