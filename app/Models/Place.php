<?php

namespace App\Models;

use App\FormatDataCollection;
use App\Search;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use Search, FormatDataCollection;
    protected $table = 'places';
    public $timestamps = true;
    protected $fillable = array('name', 'city_id', 'address', 'about', 'latitude', 'longitude', 'place_owner_id', 'phone', 'sub_category_id', 'category_id', 'is_best', 'is_accepted', 'opened_time', 'closed_time', 'closed_days', 'website', 'twitter', 'facebook', 'instagram', 'youtube', 'main_image', 'tax_record');

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\PlaceOwner', 'place_owner_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory');
    }
    public function discounts()
    {
        return $this->hasMany('App\Models\Discount');
    }
    public function availableDiscounts()
    {
        return $this->hasMany('App\Models\Discount')->available();
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
    public function countDiscounts()
    {
        $count = $this->availableDiscounts->count();
        if ($count == 1)
            return 'عرض واحد';
        if ($count == 2)
            return 'عرضان';
        else
            return $count . ' عروض';
    }
    public function scopeSearchCity($query, $city = null)
    {

        return $query->where(function ($query) use ($city) {
            if (!is_null($city))
                $query->where('city_id', $city);
        });
    }
    public function scopeSearchCategory($query, $category = null)
    {
        return $query->where(function ($query) use ($category) {
            if (!is_null($category)) {
                $query->where('category_id', $category);
            }
        });
    }
}