<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $table = 'reviews';
    public $timestamps = true;
    protected $fillable = array('client_id', 'place_id', 'rating', 'content');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function place()
    {
        return $this->belongsTo('App\Models\Place');
    }
}