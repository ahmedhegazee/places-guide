<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model 
{

    protected $table = 'discounts';
    public $timestamps = true;
    protected $fillable = array('place_id', 'title', 'content', 'discount', 'starting_date', 'end_date');

    public function place()
    {
        return $this->belongsTo('App\Models\Place');
    }

}