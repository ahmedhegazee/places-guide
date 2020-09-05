<?php

namespace App;

trait Search
{

    public function scopeSearchCity($query, $city = null)
    {
        return $query->where(function ($query) use ($city) {
            if (!is_null($city))
                $query->where('city_id', $city);
        });
    }
    public function scopeSearch($query, $search = null)
    {
        //to make the filtering by governs is optional
        return $query->where(function ($query) use ($search) {
            if (!is_null($search))
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
        });
    }
}