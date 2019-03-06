<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TurfImage extends Model
{
    protected $table = 'turf_image';

    public function turf()
    {
        return $this->belongsTo('App\Model\Turf');
    }
}
