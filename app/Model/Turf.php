<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Swis\LaravelFulltext\Indexable;

class Turf extends Model
{

    use Indexable;

    protected $indexContentColumns = ['facilities.value', 'facilities.facility'];

    protected $indexTitleColumns = ['name', 'price', 'footwear', 'address', 'type'];

    protected $table = 'turfs';

    protected $appends = ['all_images_url', 'permalink', 'average_ratings'];

    public function getAllImagesUrlAttribute () {
        return $this->images->map(function ($image) {
            return route('ajax-turf-image-id', $image->id);
        });
    }

    public function getPermalinkAttribute () {
        return route('permalink', $this->id);
    }

    public function getAverageRatingsAttribute () {
        $ratings = $this->ratings->map(function ($rate) {
            return $rate->stars;
        });
        return $ratings->average();
    }

    public function facilities()
    {
        return $this->hasMany('App\Model\TurfFacility');
    }

    public function images()
    {
        return $this->hasMany('App\Model\TurfImage');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function ratings() {
        return $this->hasMany('App\Model\Rating');
    }
}