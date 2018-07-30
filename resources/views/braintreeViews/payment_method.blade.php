<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/libraries.js') }}"></script>
        <script src="https://js.braintreegateway.com/web/dropin/1.11.0/js/dropin.min.js"></script>
        <title>Document</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="dropin-container"></div>
                <button id="submit-button">Request payment method</button>
                
            </div>
            </div>
        </div>
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
</body>
</html>


