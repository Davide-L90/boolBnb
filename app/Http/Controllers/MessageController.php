<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Apartament;
use App\Model\Message;
use App\Model\GuestUser;
use Carbon\Carbon;
class MessageController extends Controller
{
    public function sendMessage(Request $request, $apartment_id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:255',
            'email' => 'required||max:255|email',
            'message_content' => 'required|string|max:400',
        ]);

        $email_from = $request->email;    

        $guestUser = GuestUser::where('email', $email_from)->first();
        
        /* 
        check if the user already exist in guestuser table
        if not save new record 
        */

        if(is_null($guestUser)){
            $guestUser = new GuestUser();
            $guestUser->name = $request->name;
            $guestUser->surname = $request->surname;
            $guestUser->email = $email_from;
            $guestUser->save();
        }

        $new_message = new Message();
        $carbon = new Carbon(); 
        $carbon = $carbon->toDateTimeString(); 
        $new_message->apartament_id = $apartment_id;
        $new_message->guest_user_id = $guestUser->id;
        $new_message->content = $request->message_content;
        $new_message->sanding_date = $carbon;
        $new_message->save();

        dd('hola');
    }
}
