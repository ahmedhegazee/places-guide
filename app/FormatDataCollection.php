<?php

namespace App;

use App\Models\Category;
use App\Models\Governorate;

trait FormatDataCollection
{
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
    function getGovernorates()
    {
        // $arr = ['' => 'اختار المحافظة'];

        return Governorate::all()->mapWithKeys(function ($role) {
            return [
                $role->id =>  $role->name,
            ];
        })->toArray();
    }
    function getCategories()
    {
        // $arr = ['' => 'اختار المحافظة'];

        return Category::all()->mapWithKeys(function ($role) {
            return [
                $role->id =>  $role->name,
            ];
        })->toArray();
    }
}