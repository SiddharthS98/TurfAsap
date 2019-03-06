<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
