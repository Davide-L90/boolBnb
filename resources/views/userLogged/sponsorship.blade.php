@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <form action="{{ route('payment.tokenGen', $apartment_id) }}" method="GET">
                    @foreach($advertisements as $advertisement)
                        <div>
                            <input type="radio" name="sponsor" value="{{ $advertisement->id }}" id="{{ $advertisement->id }}"> <span>{{ $advertisement->price }} &euro;</span> <span>{{ $advertisement->validity }} ore</span>
                        </div>
                    @endforeach
                    
                    <input class="btn btn-primary" type="submit" value="Acquista">
                </form>
            </div>
        </div>
    </div>

@endsection