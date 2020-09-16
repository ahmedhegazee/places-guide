<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkerCategory extends Model
{

    protected $table = 'workers_categories';
    public $timestamps = true;
    protected $fillable = array('name');

    public function workers()
    {
        return $this->hasMany('App\Models\Worker');
    }
    public function ads()
    {
        return $this->hasMany('App\Models\WorkAd', 'work_category_id');
    }
}