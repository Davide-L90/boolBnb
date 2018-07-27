<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GuestUser extends Model
{
    protected $table = 'guestusers';

    public function messages()
    {
        return $this->hasMany('App\Model\Message');
    }
}
