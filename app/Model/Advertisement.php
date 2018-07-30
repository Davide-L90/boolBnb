<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    public function apartaments()
    {
        return $this->belongsToMany('App\Model\Apartament');
    }
}
