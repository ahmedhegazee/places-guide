<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name', 'governorate_id');

    public function governorate()
    {
        return $this->belongsTo('App\Models\Governorate');
    }

    public function places()
    {
        return $this->hasMany('App\Models\Place');
    }
    public function scopeGovern($query, $govern)
    {
        return $query->where('governorate_id', $govern);
    }
    public function getNameAttribute()
    {
        return collect(json_decode($this->attributes['name']))->toArray();
    }
}
