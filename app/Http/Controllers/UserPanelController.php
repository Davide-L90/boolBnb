<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Feature;
use App\Model\Apartament;
use Illuminate\Support\Facades\Auth;
use App\Model\Message;

class UserPanelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $features = Feature::all();
        $apartments = Apartament::where('user_id', $userId)->get();
        return view('userLogged.userPanel', ['features' => $features, 'apartments' => $apartments]);
    }

    public function showApartmentDetail($apartment_id)
    {
        
        $apartment_details = Apartament::find($apartment_id); 
        
        $all_features = Feature::all();
        $features_checked = Apartament::find($apartment_id)->features;

        /* 
            Create a custom features array with field 'isChecked to make appear checkbox in 
            userLogged.apartmentDetail view checked  
        */
        $list_of_features = [];
        foreach ($all_features as $feature) {            
            $item;
            if ( ($features_checked->contains('name', $feature->name)) ) {
                $item = [
                    'id' => $feature['id'],
                    'name' => $feature['name'],
                    'isChecked' => true
                ]; 
            } else {
                $item = [
                    'id' => $feature['id'],
                    'name' => $feature['name'],
                    'isChecked' => false
                ];
            }               
            $list_of_features[] = $item;
        }
        
        return view('userLogged.apartmentDetail', [
            'apartment_details' => $apartment_details,
            'apartment_features' => $list_of_features,
        ]);
    }

    public function showInbox(Request $request)
    {

        $userId = Auth::user()->id;
        $apartments = Apartament::where('user_id', $userId)->get();

        $messages = new Message();

        $joined_table = Message::join('guestusers', 'messages.guest_user_id', '=', 'guestusers.id');

        $filtered_messages = $joined_table->whereHas('apartament', function ($query) use($userId) { 
            $query->where('user_id', $userId); 
        });      
 
        /* dd($filtered_messages->sortByDesc('created_at')); */

        if ($request->ajax()) {

            $filtered_messages = $filtered_messages->join('apartaments', 'messages.apartament_id', '=', 'apartaments.id');
            
            if ($request->apartment_id == -1) {

                $filtered_messages = $filtered_messages->get();
            } else {
                $filtered_messages = $filtered_messages->where('apartament_id', $request->apartment_id)->get();
            }

            return response()->json([
                'response' => 'ok',
                'ap_id' => $request->apartment_id,
                'filtered_message' => $filtered_messages
            ]);
        }

        $filtered_messages = $filtered_messages->get();

        return view('userLogged.inbox', [
            'user_apartments' => $apartments, 
            'filtered_messages' => $filtered_messages
        ]);
    }

   
}
