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
        return $this->hasMany('App\Models\Place', 'category_id');
    }
    public function acceptedPlaces()
    {
        return $this->places()->whereDoesntHave('owner',function($query){
                $query->where('is_accepted',0);
            });
    }
    public function noOwner()
    {
        return $this->places()->whereDoesntHave('owner');
    }
}