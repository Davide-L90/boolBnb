@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 sponsor_cnt">
                <form id="sponsor_form" action="{{ route('payment.tokenGen', $apartment_id) }}" method="GET">
                    @foreach($advertisements as $advertisement)
                        <a class="sponsor">
                            <input class="advertisement" type="radio" name="sponsor" value="{{ $advertisement->id }}" id="{{ $advertisement->id }}"> <span>{{ $advertisement->price }} &euro;</span> <span>{{ $advertisement->validity }} ore</span>
                        </a>
                    @endforeach
                    
                    <input class="custom_button_invert" type="submit" value="Acquista">
                </form>
            </div>
        </div>
    </div>

@endsection