<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceReview extends Model 
{

    protected $table = 'place_review';
    public $timestamps = true;
    protected $fillable = array('place_id', 'review_id');

}