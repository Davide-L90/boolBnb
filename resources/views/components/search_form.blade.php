{!! Form::open(['id' => $data['form_data']['id'], 'class' => $data['form_data']['class']['form'], 'url' => $data['form_data']['action'], 'method' => $data['form_data']['method']]) !!}
    
    <div class="field_cnt form-group{{ $errors->has('address') ? 'has-error' : '' }}">
        <label for="address" class="control-label {{ $data['form_data']['class']['label'] }}">Indirizzo</label>
        <div class="{{ $data['form_data']['class']['input_cnt'] }}">
            <input id="address" type="text" class="form-control {{ $data['form_data']['class']['input'] }}" name="address" value="{{ !empty($data['form_data']['request_field']) ? $data['form_data']['request_field']->address : null }}" >   
        </div>
    </div>

    <div class="field_cnt hidden form-group{{ $errors->has('lat') ? ' has-error' : '' }}">
        <div class="col-md-9">
            <input id="lat" type="hidden" class="form-control" name="lat" value="{{ !empty($data['form_data']['request_field']) ? $data['form_data']['request_field']->lat : null }}" >
        </div>
    </div>

    <div class="field_cnt hidden form-group{{ $errors->has('lng') ? ' has-error' : '' }}">
        <div class="col-md-9">
            <input id="lng" type="hidden" class="form-control" name="lng" value="{{ !empty($data['form_data']['request_field']) ? $data['form_data']['request_field']->lng : null }}" >
        </div>
    </div>

    <div class="filter_cnt">
        
        <div class="field_cnt form-group{{ $errors->has('beds_number') ? 'has-error' : '' }}">
            <label for="beds_number" class="control-label {{ $data['form_data']['class']['label'] }}">Posti letto</label>
            <div class="{{ $data['form_data']['class']['input_cnt'] }}">
                <input id="beds_number" type="number" class="form-control {{ $data['form_data']['class']['input'] }}" name="beds_number" value="{{ !empty($data['form_data']['request_field']) ? $data['form_data']['request_field']->beds_number : null }}">   
            </div>
        </div>
    
        <div class="field_cnt form-group{{ $errors->has('bathrooms_number') ? 'has-error' : '' }}">
            <label for="bathrooms_number" class="control-label {{ $data['form_data']['class']['label'] }}">Numero bagni</label>
            <div class="{{ $data['form_data']['class']['input_cnt'] }}">
                <input id="bathrooms_number" type="number" class="form-control {{ $data['form_data']['class']['input'] }}" name="bathrooms_number" value="{{ !empty($data['form_data']['request_field']) ? $data['form_data']['request_field']->bathrooms_number : null }}">   
            </div>
        </div>
    
        <div class="field_cnt form-group{{ $errors->has('distance') ? 'has-error' : '' }}">
            <label for="distance" class="control-label {{ $data['form_data']['class']['label'] }}">Cerca nel raggio di Km...</label>
            <div class="{{ $data['form_data']['class']['input_cnt'] }}">
                <input id="distance" type="number" class="form-control {{ $data['form_data']['class']['input'] }}" name="distance" value="{{ !empty($data['form_data']['request_field']) ? $data['form_data']['request_field']->distance : null }}">   
            </div>
        </div>
    
        <div class="field_cnt form-group{{ $errors->has('features') ? ' has-error' : '' }}">
            @foreach($data['form_data']['chek_notcheck_feat'] as $feat)
                <label class="{{ $data['form_data']['class']['check_label'] }}" for="{{ $feat['name'] }}">{{ $feat['name'] }}</label>
                <input type="checkbox" class="{{ $data['form_data']['class']['check_input'] }}" name="features[]" id="{{ $feat['name'] }}" value="{{ $feat['id'] }}" {{ $feat['isChecked'] ? 'checked' : null}} autofocus> 
            @endforeach
        </div>    
    
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    {{ !empty($data['form_data']['request_field']) ? 'Filtra risultati' : 'Cerca' }}
                </button>
            </div>
        </div> 

    </div>


{!! Form::close() !!}


