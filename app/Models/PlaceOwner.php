<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use App\Search;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\CanResetPassword;

class PlaceOwner extends Authenticatable implements CanResetPassword
{
    use Notifiable, Search;
    protected $table = 'place_owner';
    public $timestamps = true;
    protected $fillable = array('full_name', 'email', 'password', 'account_type', 'is_banned', 'is_accepted');

    public function place()
    {
        return $this->hasOne('App\Models\Place');
    }
    public function scopeAccepted($query, $check)
    {
        return $query->where('is_accepted', $check);
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
    public $preventAccountTypeAttribute = true;
    public function getAccountTypeAttribute()
    {
        if ($this->preventAccountTypeAttribute)
            return $this->attributes['account_type'];
        // return null;
        else {
            $type = [
                0 => 'عضوية فضية',
                1 => 'عضوية الماسية'
            ];
            return
                $type[$this->attributes['account_type']];
        }
    }
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token,'owner.password.reset'));
    }
}