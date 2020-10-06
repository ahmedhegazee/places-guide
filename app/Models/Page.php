<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['name', 'content'];
    public function getContentAttribute()
    {
        return collect(json_decode($this->attributes['content']))->toArray();
    }
}
