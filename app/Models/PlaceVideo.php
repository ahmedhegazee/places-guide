<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceVideo extends Model 
{

    protected $table = 'places_videos';
    public $timestamps = true;
    protected $fillable = array('place_id', 'src');

    public function place()
    {
        return $this->belongsTo('App\Models\Place');
    }

}