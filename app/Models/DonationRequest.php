<?php

namespace App\Models;

use App\Search;
use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{
    use Search;
    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('name', 'age', 'no_blood_bags', 'phone', 'notes', 'address', 'longtitude', 'latitude', 'blood_type_id', 'city_id');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }
}
