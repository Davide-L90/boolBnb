<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Apartament;
use App\Model\Message;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function sendMessage(Request $request, $apartment_id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'message_content' => 'required|string|max:400',
        ]);

        $email_from = $request->email;    

        $new_message = new Message();

        $carbon = new Carbon();   
        dd($email_from);

    }
}
