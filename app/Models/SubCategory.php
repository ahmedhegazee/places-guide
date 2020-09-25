<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{

    protected $table = 'sub_categories';
    public $timestamps = true;
    protected $fillable = array('name', 'category_id');

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function places()
    {
        return $this->hasMany('App\Models\Place');
    }

    public function scopeCat($query, $category)
    {
        return $query->where('category_id', $category);
    }
    public function acceptedPlaces()
    {
        return $this->places()->whereHas('owner', function ($query) {
            $query->where('is_accepted', 1);
        });
    }
}