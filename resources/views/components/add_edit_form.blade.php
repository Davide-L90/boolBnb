{!! Form::open(['id' => $data['form_data']['id'], 'class' => $data['form_data']['class'], 'url' => $data['form_data']['action'], 'method' => $data['form_data']['method']]) !!}
    
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title" class="col-md-2 control-label">Title</label>
        <div class="col-md-9">
            <input id="title" type="text" class="form-control" name="title" value="{{ !empty($data['form_data']['apartment_details']) ? $data['form_data']['apartment_details']->title : null  }}" required autofocus>   
        </div>
    </div>

    <div class="form-group{{ $errors->has('beds_number') ? ' has-error' : '' }}">
        <label for="beds_number" class="col-md-2 control-label">P. Letto</label>
        <div class="col-md-9">
            <input id="beds_number" type="text" class="form-control" name="beds_number" value="{{ !empty($data['form_data']['apartment_details']) ? $data['form_data']['apartment_details']->beds_number : null }}" required autofocus>   
        </div>
    </div>

    <div class="form-group{{ $errors->has('bathrooms_number') ? ' has-error' : '' }}">
        <label for="bathrooms_number" class="col-md-2 control-label">Bagni</label>
        <div class="col-md-9">
            <input id="bathrooms_number" type="text" class="form-control" name="bathrooms_number" value="{{ !empty($data['form_data']['apartment_details']) ? $data['form_data']['apartment_details']->bathrooms_number : null }}" required autofocus>   
        </div>
    </div>

    <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
        <label for="area" class="col-md-2 control-label">Mq.</label>
        <div class="col-md-9">
            <input id="area" type="text" class="form-control" name="area" value="{{ !empty($data['form_data']['apartment_details']) ? $data['form_data']['apartment_details']->area : null }}" required autofocus>   
        </div>
    </div>

    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
        <label for="price" class="col-md-2 control-label">Prezzo</label>
        <div class="col-md-9">
            <input id="price" type="text" class="form-control" name="price" value="{{ !empty($data['form_data']['apartment_details']) ? $data['form_data']['apartment_details']->price : null }}" required autofocus>   
        </div>
    </div>

    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <label for="address" class="col-md-2 control-label">Indirizzo</label>
        <div class="col-md-9">
            <input id="address" type="text" class="form-control" name="address" value="{{ !empty($data['form_data']['apartment_details']) ? $data['form_data']['apartment_details']->address : null }}" required autofocus>   
        </div>
    </div>

    <div class="hidden form-group{{ $errors->has('lat') ? ' has-error' : '' }}">
        <div class="col-md-9">
            <input id="lat" type="text" class="form-control" name="lat" value="{{ !empty($data['form_data']['apartment_details']) ? $data['form_data']['apartment_details']->latitude : null }}" >
        </div>
    </div>

    <div class="hidden form-group{{ $errors->has('lng') ? ' has-error' : '' }}">
        <div class="col-md-9">
            <input id="lng" type="text" class="form-control" name="lng" value="{{ !empty($data['form_data']['apartment_details']) ? $data['form_data']['apartment_details']->longitude : null }}" >
        </div>
    </div>

    <div class="form-group{{ $errors->has('features') ? ' has-error' : '' }}">
        <label for="features" class="col-md-2 control-label">Servizi Aggiuntivi</label>

        <div class="col-md-9 features_cnt">
            @foreach($data['form_data']['apartment_features'] as $feature)
                <div class="feature">
                    <input type="checkbox" class="col-md-4" name="features[]" id="{{ $feature['name'] }}" value="{{ $feature['id'] }}"  {{ $feature['isChecked'] ? 'checked' : '' }} autofocus> 
                    <label class="col-md-8" for="{{ $feature['name'] }}">{{ $feature['name'] }}</label>
                </div>
            @endforeach      
        </div>
    </div>


    <div class="form-group btn_cnt">
        <div class="col-xs-12">
            <button type="submit" class="custom_button">
                {{ !empty($data['form_data']['apartment_details']) ? 'Salva modifiche' : 'Salva appartamento' }}
            </button>
            <button id="hide_form" type="" class="custom_button cancel">
                Annulla
            </button>
        </div>
    </div>  
    
    

{!! Form::close() !!}

@section('additional-scripts')

    <script>
            $(document).ready(function() {
                $("#address").geocomplete({ 
                    details: "#apartment_form" 
                });
            })
    </script>

@endsection