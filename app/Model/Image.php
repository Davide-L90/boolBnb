<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function apartament()
    {
        return $this->belongsTo('App\Model\Apartament');
    }
}
