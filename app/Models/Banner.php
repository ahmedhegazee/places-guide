<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable=['content','image','title'];
    public function getContentAttribute()
    {
        return collect(json_decode($this->attributes['content']))->toArray();
    }
    public function getTitleAttribute()
    {
        return collect(json_decode($this->attributes['title']))->toArray();
    }
}
