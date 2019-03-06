<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = "ratings";

    protected $appends = ['user_name'];

    public function getUserNameAttribute() {
        return $this->user->name;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function turf()
    {
        return $this->belongsTo('App\Model\Turf');
    }
}
