<?php

use App\Models\WorkAd;
use Illuminate\Database\Seeder;

class WorkAdsTableSeeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkAd::create([
            'place_id' => 1,
            'work_category_id' => 1,
            'title' => 'نحتاج الى معلمين شاورما',
            'content' => 'ساعات العمل ١٢ ساعة
المرتب ٤٠٠٠ جنيه',
            'quantity' => 4,
            'phone' => '0111111111'
        ]);
    }
}