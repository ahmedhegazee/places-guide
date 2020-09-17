<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('name', 'image');

    public function subCategories()
    {
        return $this->hasMany('App\Models\SubCategory');
    }

    public function places()
    {
        // return $this->hasManyThrough('App\Models\Place', 'App\Models\SubCategory');
        return $this->hasMany('App\Models\Place');
    }
    public function acceptedPlaces()
    {
        return $this->places()->whereHas('owner', function ($query) {
            $query->where('is_accepted', 1);
        });
    }
}