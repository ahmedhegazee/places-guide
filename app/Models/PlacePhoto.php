<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlacePhoto extends Model 
{

    protected $table = 'places_photos';
    public $timestamps = true;
    protected $fillable = array('place_id', 'src');

    public function place()
    {
        return $this->belongsTo('App\Models\Place');
    }

}