<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{

    protected $table = 'governorates';
    public $timestamps = true;
    protected $fillable = array('name');

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    public function places()
    {
        return $this->hasManyThrough('App\Models\Place', 'App\Models\City');
    }
    public function getNameAttribute()
    {
        return collect(json_decode($this->attributes['name']))->toArray();
    }
}
