<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'photo', 'category_id');

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function favouritedClients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }
    public function scopeSearchCategory($query, $category = null)
    {
        //to make the filtering by governs is optional
        return $query->where(function ($query) use ($category) {
            if (!is_null($category))
                $query->where('category_id', $category);
        });
    }
    public function scopeContent($query, $content = null)
    {
        //to make the filtering by governs is optional
        return $query->where(function ($query) use ($content) {
            if (!is_null($content))
                $query->where('content', 'like', '%' . $content . '%')->orWhere('title', 'like', '%' . $content . '%');
        });
    }
}
