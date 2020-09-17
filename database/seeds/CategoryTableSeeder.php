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
            'name' => 'مطاعم',
            'image' => 'https://storage.googleapis.com/list-directory/categories/sUhUy73d7xmW9YLMzst5Mqe3AKCyMiWJpgR5xFXz.jpeg'
        ]);
        $cat->subCategories()->create(['name' => 'مطاعم مصرية']);
        $cat->subCategories()->create(['name' => 'مطاعم سورية']);
        Category::create([
            'name' => 'صيدليات',
            'image' => 'https://storage.googleapis.com/list-directory/categories/RrrudfFzaM3AIW8rbfRvlTZbQcxV0uE2d1Wm2IYh.jpeg'
        ]);
        Category::create([
            'name' => 'مكاتب سفريات',
            'image' => 'https://storage.googleapis.com/list-directory/categories/jQHhgeGxJtZyIjdHWAEahwEJEreqjLtsm1cyxonM.jpeg'
        ]);
        Category::create([
            'name' => 'ورش نجارة',
            'image' => 'https://storage.googleapis.com/list-directory/categories/KnsqoZfczDHpdQfqCIjsftPhGynSPcQfXRbUJzI9.jpeg'
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