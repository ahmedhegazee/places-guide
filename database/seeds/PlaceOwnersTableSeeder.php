<?php

use App\Models\Place;
use App\Models\PlaceOwner;
use Illuminate\Database\Seeder;

class PlaceOwnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = PlaceOwner::create([
            'full_name' => 'أحمد حجازي',
            'email' => 'hegz@email.com',
            'password' => '$2y$10$8ehsJFHfutYrtyGGBbmDFeBDe/yoO2scXqur/gW1DBhwK8qgzmram',
            'account_type' => 0,
            'is_accepted' => 1
        ]);
        $owner->place()->create([
            'name' => 'مطعم الدوار المصري',
            'city_id' => 1,
            'address' => 'المدينة',
            'about' => 'مطعم يقدم افضل الاكلات المصرية بايدي محترفة',
            'phone' => '01113353945',
            'tax_record' => '0123456789',
            'sub_category_id' => 1,
            'category_id' => 1,
            'opened_time' => '17:15:00',
            'closed_time' => '23:15:00',
            'closed_days' => 'Wednesday',
            'main_image' => 'images/company.png'
        ]);

        $owner = PlaceOwner::create([
            'full_name' =>  'احمد علي',
            'email' => 'ali@email.com',
            'password' => '$2y$10$8ehsJFHfutYrtyGGBbmDFeBDe/yoO2scXqur/gW1DBhwK8qgzmram',
            'account_type' => 1,
            'is_accepted' => 1
        ]);
        $owner->place()->create([
            'name' => 'مطعم السما',
            'city_id' => 2,
            'address' => 'المدينة',
            'about' => 'مطعم السما',
            'latitude' => 52.081166,
            'longitude' => 5.403471,
            'phone' => '01233687901',
            'tax_record' => '12345678',
            'sub_category_id' => 1,
            'category_id' => 1,
            'opened_time' => '07:22:00',
            'closed_time' => '11:22:00',
            'closed_days' => 'Thursday',
            'main_image' => 'https://storage.googleapis.com/list-directory/images/UNYjBSPj5gQ40qIAucgEtrUthjhEkzk0IW6jyUR0.jpeg'
        ]);
    }
}