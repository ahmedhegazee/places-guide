<?php

namespace App\Models;

use App\Search;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    // use Search;
    protected $table = 'places';
    public $timestamps = true;
    protected $fillable = array('name', 'city_id', 'address', 'about', 'latitude', 'longitude', 'place_owner_id', 'phone', 'sub_category_id', 'is_best', 'is_accepted', 'opened_time', 'closed_time', 'closed_days', 'website', 'twitter', 'facebook', 'instagram', 'youtube', 'main_image', 'tax_record');

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\PlaceOwner', 'place_owner_id');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory');
    }
    public function discounts()
    {
        return $this->hasMany('App\Models\Discount');
    }
    public function photos()
    {
        return $this->hasMany('App\Models\PlacePhoto');
    }

    public function videos()
    {
        return $this->hasMany('App\Models\PlaceVideo');
    }

    public function reviews()
    {
        return $this->belongsToMany('App\Models\Review');
    }

    public function ads()
    {
        return $this->hasMany('App\Models\WorkAd');
    }
    public $preventClosedDaysAttribute = true;
    public function getClosedDaysAttribute()
    {
        if ($this->preventClosedDaysAttribute)
            return $this->attributes['closed_days'];
        else {
            $arr = explode(',', $this->attributes['closed_days']);
            $days = [];
            // dd($this->attributes['closed_days']);
            for ($i = 0; $i < sizeOf($arr); $i++) {
                array_push($days, $this->getDays()[$arr[$i]]);
            }
            return implode(',', $days);
        }
    }
    function getDays()
    {
        return [
            'Sunday' =>  'الاحد',
            'Monday' =>  'الاثنين',
            'Tuesday' =>  'الثلاثاء',
            'Wednesday' =>  'الاربعاء',
            'Thursday' =>  'الخميس',
            'Friday' =>  'الجمعة',
            'Saturday' =>  'السبت',
        ];
    }
}