<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    public function apartaments()
    {
        return $this->belongsToMany('App\Model\Apartament');
    }
}
