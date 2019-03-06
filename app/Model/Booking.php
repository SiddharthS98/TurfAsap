<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "bookings";

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function turf()
    {
        return $this->belongsTo('App\Model\Turf');
    }

    public function card()
    {
        return $this->belongsTo('App\Model\Card');
    }
}
