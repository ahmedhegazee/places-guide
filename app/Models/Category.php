<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('name');

    public function subCategories()
    {
        return $this->hasMany('App\Models\SubCategory');
    }

    public function places()
    {
        return $this->hasManyThrough('App\Models\Place', 'App\Models\SubCategory');
    }
}