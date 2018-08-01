<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Feature;
use App\Model\Apartament;
use Illuminate\Support\Facades\Auth;
use App\Model\Message;
use App\Model\Image;
use Illuminate\Support\Facades\Storage;


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

        foreach ($apartments as $apartment) {            
            $thumbnail = Image::where('apartament_id', $apartment->id)->first();

            if ( !(is_null($thumbnail)) && (Storage::disk('public')->exists($thumbnail->filename)) ) {
                $thumbnail = $thumbnail->filename;     
            }
            else{
                $thumbnail = 'placeholder.jpg';
            }
            $apartment['thumbnail'] = $thumbnail;            
        }        

        $list_of_features = [];
        foreach ($features as $feature) {
            $item = [
                'id' => $feature['id'],
                'name' => $feature['name'],
                'isChecked' => false
            ];

            $list_of_features[] = $item;
        }

        /* create an array to send data at view and form */
        $data = [
            'form_data' => [
                'id' => 'apartment_form',
                'class' => 'form-horizontal',
                'action' => route('apartaments.store'),
                'method' => 'POST',
                'apartment_details' => [],
                'apartment_features' => $list_of_features,
            ]
        ];

        return view('userLogged.userPanel', [
            'apartments' => $apartments, 
            'data' => $data
        ]);
    }

    public function showApartmentDetail($apartment_id)
    {
        
        $apartment_details = Apartament::find($apartment_id); 
        
        $all_features = Feature::all();
        $features_checked = Apartament::find($apartment_id)->features;

        // Retrieve all images for the apartment
        $images = Image::where('apartament_id', $apartment_id)->get();
        $filteredImages = collect();

        if($images->isNotEmpty())
        {
            $filteredImages = $images->reject(function($value, $key){
                $canDelete = false;
                if (!(Storage::disk('public')->exists($value->filename)) ) {
                    $canDelete = true;
                }
                return $canDelete;
            });
        }

        /* 
            Create a custom features array with field 'isChecked' to make appear checked 
            the checkbox in userLogged.apartmentDetail view 
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

        $data = [
            'form_data' => [
                'id' => 'apartment_form',
                'class' => 'form-horizontal',
                'action' => route('apartaments.update', $apartment_details->id),
                'method' => 'PUT',
                'apartment_details' => $apartment_details,
                'apartment_features' => $list_of_features,
            ]
        ];
        
        return view('userLogged.apartmentDetail', ['data' => $data, 'images' => $filteredImages]);
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
