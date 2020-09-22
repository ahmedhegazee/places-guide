<?php

namespace App\Models;

use App\Search;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\CanResetPassword;

class Client extends Authenticatable implements CanResetPassword
{
    use Notifiable, Search;
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('full_name', 'email', 'password', 'is_banned', 'phone', 'city_id');

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }
    public $preventGetAttr = false;
    public function getIsBannedAttribute()
    {
        if ($this->preventGetAttr)
            return $this->attributes['is_banned'];
        else {
            $status = [
                0 => 'غير محظور',
                1 => 'محظور',
            ];
            return $status[$this->attributes['is_banned']];
        }
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
    public function isReviewed($placeId)
    {
        return !$this->reviews()->where('place_id', $placeId)->count();
    }
}