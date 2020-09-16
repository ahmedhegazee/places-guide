<?php

use App\Models\Category;
use App\Models\WorkerCategory;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = Category::create([
            'name' => 'مطاعم'
        ]);
        $cat->subCategories()->create(['name' => 'مطاعم مصرية']);
        $cat->subCategories()->create(['name' => 'مطاعم سورية']);
        Category::create([
            'name' => 'صيدليات'
        ]);
        Category::create([
            'name' => 'مكاتب سفريات'
        ]);
        Category::create([
            'name' => 'ورش نجارة'
        ]);
        WorkerCategory::create([
            'name' => 'معلم شاورما'
        ]);
        WorkerCategory::create([
            'name' => 'نجار'
        ]);
        WorkerCategory::create([
            'name' => 'كاشير'
        ]);
        WorkerCategory::create([
            'name' => 'طباخ'
        ]);
        WorkerCategory::create([
            'name' => 'مبيعات'
        ]);
        // Category::create([
        //     'name' => 'ادوية'
        // ]);
        // Category::create([
        //     'name' => 'اغذية'
        // ]);
    }
}