@extends('layouts.app')
<script src=" {{ config('external_api.google_maps.base_path') }}&key={{ config('external_api.google_maps.api_key') }}"></script>

@section('content')
    
    <div class="container apartment-detail">
        <div class="row">

            <div class="images-cnt col-md-6">
                images
            </div>
            <div class="details-cnt col-md-6">
                <div class="panel-body">   
                                      
                    <form id="apartment_form" class="form-horizontal" method="POST" action=" {{ route('apartaments.update', $apartment_details->id) }} ">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">Title</label>
                            <div class="col-md-9">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $apartment_details->title }}" required autofocus>   
                            </div>
                        </div> 

                        <div class="form-group{{ $errors->has('beds_number') ? ' has-error' : '' }}">
                            <label for="beds_number" class="col-md-2 control-label">Stanze</label>
                            <div class="col-md-9">
                                <input id="beds_number" type="text" class="form-control" name="beds_number" value="{{ $apartment_details->beds_number }}" required autofocus>   
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('bathrooms_number') ? ' has-error' : '' }}">
                            <label for="bathrooms_number" class="col-md-2 control-label">Bagni</label>
                            <div class="col-md-9">
                                <input id="bathrooms_number" type="text" class="form-control" name="bathrooms_number" value="{{ $apartment_details->bathrooms_number }}" required autofocus>   
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                            <label for="area" class="col-md-2 control-label">Metri quadrati</label>
                            <div class="col-md-9">
                                <input id="area" type="text" class="form-control" name="area" value="{{ $apartment_details->area }}" required autofocus>   
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-2 control-label">Prezzo</label>
                            <div class="col-md-9">
                                <input id="price" type="text" class="form-control" name="price" value="{{ $apartment_details->price }}" required autofocus>   
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-2 control-label">Indirizzo</label>
                            <div class="col-md-9">
                                <input id="address" type="text" class="form-control" name="address" value="{{ $apartment_details->address }}" required autofocus>   
                            </div>
                        </div>

                        <div class="hidden form-group{{ $errors->has('lat') ? ' has-error' : '' }}">
                            <div class="col-md-9">
                                <input id="lat" type="text" class="form-control" name="lat" value="{{ $apartment_details->latitude }}" >
                            </div>
                        </div>

                        <div class="hidden form-group{{ $errors->has('lng') ? ' has-error' : '' }}">
                            <div class="col-md-9">
                                <input id="lng" type="text" class="form-control" name="lng" value="{{ $apartment_details->longitude }}" >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('features') ? ' has-error' : '' }}">
                            <label for="features" class="col-md-2 control-label">Servizi Aggiuntivi</label>

                            <div class="col-md-9">
                                @foreach($apartment_features as $feature)
                                    <label class="col-md-8" for="{{ $feature['name'] }}">{{ $feature['name'] }}</label>
                                    <input type="checkbox" class="col-md-4" name="features[]" id="{{ $feature['name'] }}" value="{{ $feature['id'] }}"  {{ $feature['isChecked'] ? 'checked' : '' }} autofocus> 
                                @endforeach      
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Salva modifiche
                                </button>
                            </div>
                        </div>   
                    </form>        
            </div>
            <div class="buttons-cnt">
                buttons
            </div>
        </div>
    </div>

@endsection

@section('additional-scripts')

<script>
        $(document).ready(function() {
            $("#address").geocomplete({ 
                details: ".apartment_form" 
            });
        })
</script>

@endsection