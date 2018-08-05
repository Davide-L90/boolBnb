@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="dropin-container"></div>
                <button id="submit-button">Request payment method</button>        
            </div>
        </div>
    </div>
@endsection


@section('additional-scripts') 
    <script src="https://js.braintreegateway.com/web/dropin/1.11.0/js/dropin.min.js"></script>
    <script>
        var button = document.querySelector('#submit-button');
        var url = "{{ route('payment.process', $apartment_id) }}";
        var amount =  "{{ $advertisement_price }}";
        var advertisement_id = "{{ $advertisement_id }}";

        
        

        braintree.dropin.create({
            authorization: "{{ $token }}",
            container: '#dropin-container'
        },  function (createErr, instance) {
                button.addEventListener('click', function () {
                    instance.requestPaymentMethod(function (err, payload) {
                        $.ajax({
                            url : url,
                            method : "GET",
                            data : {
                                'payload' : payload,
                                'amount' : amount,
                                'advertisement_id' : parseInt(advertisement_id)
                            },
                            success : function (data) {
                                console.log(data);
                            },
                            error : function(error) {
                                console.log(error);
                            }
                        }); 
                    });
                });
        });
    </script>
@endsection



