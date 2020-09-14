<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkAd extends Model
{

    protected $table = 'work_ads';
    public $timestamps = true;
    protected $fillable = array('work_category_id', 'place_id', 'title', 'content', 'quantity');

    public function place()
    {
        return $this->belongsTo('App\Models\Place');
    }
    public function workerCategory()
    {
        return $this->belongsTo('App\Models\WorkerCategory', 'work_category_id');
    }
    // public function workers()
    // {
    //     return $this->belongsToMany('App\Models\Worker', 'workers_requests')->withTimestamps()->withPivot('is_accepted');
    // }

}