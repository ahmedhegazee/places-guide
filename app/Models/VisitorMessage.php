<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorMessage extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'messgAddres', 'messageText'];
}