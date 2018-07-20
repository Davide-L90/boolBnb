@extends('layouts.app')
<script src=" {{ config('external_api.google_maps.base_path').'&key='.config('external_api.google_maps.api_key') }} "></script>
<script src="{{ asset('js/app.js') }}"></script>

@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  {{--   @if (session('status')) --}}
                        <div class="alert alert-success">
                            {{-- {{ session('status') }} --}}
                        </div>
                    {{-- @endif --}}

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">                
                <div class="panel-heading">Your Apartments</div>
                    <div class="panel-body">
                        <button>Inserisci nuovo appartamento</button>
                    </div>
            </div>                
        </div>    
    </div>    
</div>



<div class="container apartments-add-form">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">                
                <div class="panel-heading">Add Apartments detail</div>
                    
                <div class="panel-body">                        
                    <form id="apartment_register_form" class="form-horizontal" method="POST" action=" {{ route('test') }} ">
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

                        <div class="form-group{{ $errors->has('rooms_number') ? ' has-error' : '' }}">
                            <label for="rooms_number" class="col-md-2 control-label">Numero stanze</label>

                            <div class="col-md-9">
                                <input id="rooms_number" type="text" class="form-control" name="rooms_number" value="{{ old('rooms_number') }}" required autofocus>
                                @if ($errors->has('rooms_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rooms_number') }}</strong>
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
                            <label for="lat" class="col-md-2 control-label">Latitudine</label>

                            <div class="col-md-9">
                                <input id="lat" type="text" class="form-control" name="lat" value="{{ old('lat') }}" required autofocus>
                                @if ($errors->has('lat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="hidden form-group{{ $errors->has('lng') ? ' has-error' : '' }}">
                            <label for="lng" class="col-md-2 control-label">Longitudine</label>

                            <div class="col-md-9">
                                <input id="lng" type="text" class="form-control" name="lng" value="{{ old('lng') }}" required autofocus>
                                @if ($errors->has('lng'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lng') }}</strong>
                                    </span>
                                @endif
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
<script>
    $(document).ready(function() {
        $("#address").geocomplete({ 
            details: "#apartment_register_form" 
        });
    })
</script>

