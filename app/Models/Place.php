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
    protected $fillable = array('name', 'city_id', 'address', 'about', 'latitude', 'longitude', 'place_owner_id', 'phone', 'sub_category_id', 'category_id', 'is_best', 'is_accepted', 'opened_time', 'closed_time', 'closed_days', 'website', 'twitter', 'facebook', 'instagram', 'youtube', 'main_image', 'tax_record', 'video');

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

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
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
            if(strlen($this->attributes['closed_days'])>0){
                $arr = explode(',', $this->attributes['closed_days']);
                $days = [];

                // dd($this->attributes['closed_days']);
                for ($i = 0; $i < sizeOf($arr); $i++) {
                    array_push($days, $this->getDays()[$arr[$i]]);
                }
                return implode(',', $days);
            }else {
                return 'مفتوح طول ايام الاسبوع';
            }
            
        }
    }
    public function countDiscounts()
    {
        $count = $this->availableDiscounts->count();
        if ($count == 0)
            return null;
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
    public function scopeSearchSubCategory($query, $category = null)
    {
        return $query->where(function ($query) use ($category) {
            if (!is_null($category)) {
                $query->where('sub_category_id', $category);
            }
        });
    }

    public $enableRatingAttribute = false;
    protected $appends = ['rating'];
    public function getRatingAttribute()
    {
        if ($this->enableRatingAttribute) {
            $count = $this->reviews->count();
            if ($count > 0) {
                return floatval($this->reviews->avg('rating'));
            } else
                return 0;
        } else {
            return null;
        }
    }
    public function getMainImageAttribute()
    {

        if ($this->attributes['main_image'] == 'images/company.png')
            return asset('images/company.png');
        else
            return $this->attributes['main_image'];
    }

    public function scopeBest($query)
    {
        return $query->where('is_best', 1);
    }
    public function scopeNearest($query, $lat, $long)
    {
        //6380 =>is for km and it is the radius of earth
        //< 10000 means less than 10 km
        return $query->whereRaw("ACOS(SIN(RADIANS(latitude))*SIN(RADIANS($lat))+COS(RADIANS(latitude))*COS(RADIANS($lat))*COS(RADIANS(longitude)-RADIANS($long)))*6380 < 10");
    }
    public function scopeAvailable($query)
    {
        $query->whereHas('owner', function ($query) {
            $query->accepted(1);
        })->orWhere('place_owner_id', null);
    }
    public $preventIsBest = true;
    public function getIsBestAttribute()
    {
        if ($this->preventIsBest) {
            return $this->attributes['is_best'];
        } else {
            return [
                0 => 'لا',
                1 => 'نعم'
            ][$this->attributes['is_best']];
        }
    }
}