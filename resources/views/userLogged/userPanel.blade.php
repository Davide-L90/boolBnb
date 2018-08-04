@extends('layouts.app')


@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 section_cnt">                           
            <div id="section_title">Your Apartments</div> 
            <div class="apartments-list-cnt">
                {{-- Apartments list --}}
                @if(!empty($apartments))
                    @foreach($apartments as $apartment)
                        <div class="card{{ !($apartment->is_active) ? ' disabled-card' : null }}">
                            <div class="img_cnt">
                                <img class="img-responsive" src="{{ asset('storage/'.$apartment->thumbnail) }}" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $apartment->title }}</h5>
                                <a href=" {{ route('ownerApartmentDetails', $apartment->id) }} " class="btn custom_btn_show">Visualizza dettagli</a>
                                <a class="btn btn-danger delete-id custom_btn_delete" data-route-delete="{{ route('apartaments.destroy', $apartment->id) }}" href="#">Elimina</a> 
                                <form action="{{ route('apartaments.update', $apartment->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="isActive" value="{{ $apartment->is_active ? 1 : 0 }}" class="secret">    
                                    <input type="submit" value="{{ $apartment->is_active ? 'Disattiva annuncio' : 'Attiva annuncio' }}" class="switch btn custom_btn_disable">
                                </form>
                            </div>
                        </div>   
                    @endforeach
                @else
                    <div>Resgistra un appartamento</div>
                @endif            
                <div class="card add_btn">
                    <button id="addApartment"><span>+</span></button>
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
                    <div class="panel-heading">
                        Add Apartments detail
                    </div>

                    @include('components.add_edit_form')                        
                    
                </div>                
            </div>    
        </div>
    </div>
</div>

@endsection

