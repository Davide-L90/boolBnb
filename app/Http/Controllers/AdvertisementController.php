<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Apartament;
use App\Model\Advertisement;
use Braintree\Gateway;
use Braintree_Transaction;
use Carbon\Carbon;

class AdvertisementController extends Controller
{
    public function index($apartment_id)
    {
        $advertisements = Advertisement::all();
        
        return view('userLogged.sponsorship', [
            'apartment_id' => $apartment_id,
            'advertisements' => $advertisements
        ]);
    }

    public function tokenGen(Request $request, $apartment_id)
    {
        $advertisement_id = $request->sponsor;
        $advertisement_price = Advertisement::where('id', $advertisement_id)->first()->price;
        
        
        // get current logged in customer
        $customer = Auth::user();

        // using your customer id we will create
        // brain tree customer id with same id
        $response = \Braintree_Customer::create([
            'id' => $customer->id
        ]);
        
        $gateway = new Gateway([
                'environment' => env('BRAINTREE_ENV', false),
                'merchantId' => env('BRAINTREE_MERCHANT_ID', false),
                'publicKey' => env('BRAINTREE_PUBLIC_KEY', false),
                'privateKey' => env('BRAINTREE_PRIVATE_KEY', false)
            ]);

        $clientToken = $gateway->clientToken()->generate();

        return view('braintreeViews.payment_method', [
            'token' => $clientToken,
            'apartment_id' => $apartment_id,
            'advertisement_id' => $advertisement_id,
            'advertisement_price' => $advertisement_price            
        ]);
        
    }

    public function process(Request $request, $apartment_id)
    {   
        /* dd($request); */
        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];

        $status = Braintree_Transaction::sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if ($status->success) {
            $apartment = Apartament::find($apartment_id);
            $advertisement = Advertisement::find($request->advertisement_id); 

            $date_now = new Carbon();
            $end_date = $date_now->addHour(20);

            $apartment->advertisements()->attach($advertisement->id, ['valid_until' => $end_date]);
            
        }
        
        $request->session()->flash('status', 'Il pagamento è stato effettuato correttamente');
        $request->session()->flash('error', 'Si è verificato un errore. Esegui nuovamente il pagamaento');

        return response()->json($status);
    }
}
