<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = ['donation_request_id', 'title', 'content'];
    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }

    public function donationRequest()
    {
        return $this->belongsTo('App\Models\DonationRequest');
    }
}
