<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function apartament()
    {
        return $this->belongsTo('App\Model\Apartament');
    }

    public function guestUser()
    {
        return $this->belongsTo('App\Model\GuestUser');
    }
}
