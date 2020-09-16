<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkAd extends Model
{

    protected $table = 'work_ads';
    public $timestamps = true;
    protected $fillable = array('work_category_id', 'place_id', 'title', 'content', 'quantity', 'phone');

    public function place()
    {
        return $this->belongsTo('App\Models\Place');
    }

    public function workerCategory()
    {
        return $this->belongsTo('App\Models\WorkerCategory', 'work_category_id');
    }
    public function scopeSearchCategory($query, $category = null)
    {
        return $query->where(function ($query) use ($category) {
            if (!is_null($category)) {
                $query->where('work_category_id', $category);
            }
        });
    }
    // public function workers()
    // {
    //     return $this->belongsToMany('App\Models\Worker', 'workers_requests')->withTimestamps()->withPivot('is_accepted');
    // }

}