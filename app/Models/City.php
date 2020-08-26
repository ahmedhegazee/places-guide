<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name');

    public function government()
    {
        return $this->belongsTo('App\Models\Government');
    }



    public function scopeGovern($query, $govern = null)
    {
        //to make the filtering by governs is optional
        /*return $query->where(function ($query) use ($govern) {
            if (!is_null($govern))
                $query->where('government_id', $govern);
        });*/
        return $query->where('government_id', $govern);
    }
}
