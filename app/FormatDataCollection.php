<?php

namespace App;

use App\Models\Category;
use App\Models\Governorate;

trait FormatDataCollection
{

    function getDays()
    {
        $days=[
            'ar'=>[
                'Sunday' =>  'الاحد',
                'Monday' =>  'الاثنين',
                'Tuesday' =>  'الثلاثاء',
                'Wednesday' =>  'الاربعاء',
                'Thursday' =>  'الخميس',
                'Friday' =>  'الجمعة',
                'Saturday' =>  'السبت',
            ],
            'en'=>[
                'Sunday' =>  'Sunday',
                'Monday' =>  'Monday',
                'Tuesday' =>  'Tuesday',
                'Wednesday' =>  'Wednesday',
                'Thursday' =>  'Thursday',
                'Friday' =>  'Friday',
                'Saturday' =>  'Saturday',
            ],
            'fr'=>[
                'Sunday' =>  'Dimanche',
                'Monday' =>  'Lundi',
                'Tuesday' =>  'Mardi',
                'Wednesday' =>  'Mercredi',
                'Thursday' =>  'Jeudi',
                'Friday' =>  'Vendredi',
                'Saturday' =>  'Samedi',
            ],
            'de'=>[
                'Sunday' =>  'Sonntag',
                'Monday' =>  'Montag',
                'Tuesday' =>  'Dienstag',
                'Wednesday' =>  'Mittwoch',
                'Thursday' =>  'Donnerstag',
                'Friday' =>  'Freitag',
                'Saturday' =>  'Samstag',
            ],
            'nl'=>[
                'Sunday' =>  'zondag',
                'Monday' =>  'maandag',
                'Tuesday' =>  'dinsdag',
                'Wednesday' =>  'woensdag',
                'Thursday' =>  'donderdag',
                'Friday' =>  'vrijdag',
                'Saturday' =>  'zaterdag',
            ],
        ];

        return $days[app()->getLocale()];
    }
    function getGovernorates()
    {
        // $arr = ['' => 'اختار المحافظة'];

        return Governorate::all()->mapWithKeys(function ($role) {
            return [
                $role->id =>  $role->name[app()->getLocale()],
            ];
        })->toArray();
    }
    function getCategories()
    {
        // $arr = ['' => 'اختار المحافظة'];

        return Category::all()->mapWithKeys(function ($role) {
            return [
                $role->id =>  $role->name[app()->getLocale()],
            ];
        })->toArray();
    }
}
