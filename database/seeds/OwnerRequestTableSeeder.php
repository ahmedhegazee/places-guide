<?php

use App\Models\PlaceOwner;
use Illuminate\Database\Seeder;

class OwnerRequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = PlaceOwner::create([
            'full_name' => 'خالد وليد',
            'email' => 'khaledwaleed@email.com',
            'password' => '$2y$10$8ehsJFHfutYrtyGGBbmDFeBDe/yoO2scXqur/gW1DBhwK8qgzmram',
            'account_type' => 0,
            'is_accepted' => 0
        ]);
        $owner->place()->create([
            'name' => 'مطعم ابو مازن السوري',
            'city_id' => 2,
            'address' => 'وسط المدينة',
            'about' => 'مطعم سوري للاكلات السورية',
            'phone' => '01233687922',
            'tax_record' => '01234567899',
            'sub_category_id' => 2,
            'category_id' => 1,
            'opened_time' => '06:34:00',
            'closed_time' => '11:34:00',
            'closed_days' => 'Wednesday',
            'main_image' => 'images/company.png'
        ]);
        $owner = PlaceOwner::create([
            'full_name' => ' سالم محمد',
            'email' => 'saleem@email.com',
            'password' => '$2y$10$8ehsJFHfutYrtyGGBbmDFeBDe/yoO2scXqur/gW1DBhwK8qgzmram',
            'account_type' => 1,
            'is_accepted' => 0
        ]);
        $owner->place()->create([
            'name' => 'مطعم الريف المصري',
            'city_id' => 1,
            'address' => 'وسط المدينة',
            'about' => 'مطعم لاكلات الريف المصري',
            'phone' => '01113353966',
            'tax_record' => '0123456788',
            'latitude' => 50.081166,
            'longitude' => 5.403471,
            'sub_category_id' => 2,
            'category_id' => 1,
            'opened_time' => '09:37:00',
            'closed_time' => '11:37:00',
            'closed_days' => 'Thursday',
            'main_image' => 'images/company.png'
        ]);
    }
}