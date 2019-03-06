<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TurfFacility extends Model
{
    protected $table = 'turf_facility';

    public function turf()
    {
        return $this->belongsTo('App\Model\Turf');
    }
}
