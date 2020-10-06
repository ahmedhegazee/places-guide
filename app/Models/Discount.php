<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{

    protected $table = 'discounts';
    public $timestamps = true;
    protected $fillable = array('place_id', 'title', 'content', 'discount', 'starting_date', 'end_date', 'image');

    public function place()
    {
        return $this->belongsTo('App\Models\Place');
    }
    public function scopeAvailable($query)
    {
        return $query->where('starting_date', '<=', now()->toDateString())
            ->where('end_date', '>=', now()->toDateString());
    }
    public function getTitleAttribute()
    {
        return collect(json_decode($this->attributes['title']))->toArray();
    }
    public function getContentAttribute()
    {
        return collect(json_decode($this->attributes['content']))->toArray();
    }
}
