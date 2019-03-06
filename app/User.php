<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image_path', 'phone', 'role_id', 'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['image'];

    public function getImageAttribute () {
        return route('ajax-user-image-id', $this->id);
    }

    public function turfs ()
    {
        return $this->hasMany('App\Model\Turf');
    }

    public function role ()
    {
        return $this->belongsTo('App\Model\Role');
    }

    public function accounts ()
    {
        return $this->hasMany('App\Model\Account');
    }

    public function bookings ()
    {
        return $this->hasMany('App\Model\Booking');
    }

    public function cards ()
    {
        return $this->hasMany('App\Model\Card');
    }

    public function ratings ()
    {
        return $this->hasMany('App\Model\Ratings');
    }

}
