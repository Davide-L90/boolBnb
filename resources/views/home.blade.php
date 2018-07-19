@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->

<button>Inserisci nuovo appartamento</button>

<form action="" method="post">
    <input type="text" placeholder="Titolo appartamento">
    <input type="text" placeholder="Numero stanze">
    <input type="text" placeholder="Posti letto">
    <input type="text" name="" id="" placeholder="Numero bagni">
    <input type="text" name="" id="" placeholder="Metri quadrati">
    <input type="text" name="" id="" placeholder="Indirizzo">
    <input type="text" name="" id="" placeholder="Immagine appartamento">
    <input type="text" name="" id="" placeholder="Prezzo affitto">

    @foreach($features as $feature)
    <input type="checkbox" name="services[]" id="" value="{{ $feature['id'] }}"> {{ $feature['name']}}

    @endforeach

    <input type="submit" value="Aggiungi appartamento">
</form>
@endsection
