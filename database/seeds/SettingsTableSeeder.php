<?php

use App\Models\Page;
use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'name' => 'email',
            'value' => 'mazenanwar47@yahoo.com',
        ]);
        Settings::create([
            'name' => 'phone',
            'value' => '01006383877',
        ]);
        Settings::create([
            'name' => 'youtube',
            'value' => 'http://youtube.com/bloodbank',
        ]);
        Settings::create([
            'name' => 'facebook',
            'value' => 'http://facebook.com/bloodbank',
        ]);
        Settings::create([
            'name' => 'instagram',
            'value' => 'http://instagram.com/bloodbank',
        ]);
        Settings::create([
            'name' => 'twitter',
            'value' => 'http://twitter.com/bloodbank',
        ]);
        Settings::create([
            'name' => 'playstore',
            'value' => 'https://play.google.com/store/apps/details?id=com.bloodbank&hl=en',
        ]);
        Settings::create([
            'name' => 'appstore',
            'value' => 'https://apps.apple.com/us/app/bloodbank/id310633997',
        ]);
        Settings::create([
            'name' => 'fax',
            'value' => '4123412',
        ]);
        $paragraph = 'بنك الدم هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد النص العرب حيث يمكنك ان تولد هذا النص أو العديد من النصوص الأخرى وإضافة الى زيادة عدد الحروف التى يولدها التطبيق بنك الدم هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد النص العرب حيث يمكنك ان تولد هذا النص أو العديد من النصوص الأخرى';
        $content = array_fill(0, 3, $paragraph);

        Page::create([
            'name' => 'about',
            'content' => join('', $content)
        ]);
    }
}