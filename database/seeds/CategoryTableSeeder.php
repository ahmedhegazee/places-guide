<?php

use App\Models\Category;
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
        // Category::create([
        //     'name' => 'ادوية'
        // ]);
        // Category::create([
        //     'name' => 'اغذية'
        // ]);
    }
}