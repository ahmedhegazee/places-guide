<?php

use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discount::create([
            'place_id' => 1,
            'title' => 'خصم ٢٠٪',
            'content' => '٢٠٪',
            'discount' => '٢٠٪',
            'starting_date' => '2020-09-16',
            'end_date' => '2020-09-17',
            'image' => 'https://storage.googleapis.com/list-directory/images/biFQB76OBnHEZkGAOGuaphX9XJgyYPCyl5TeWkaf.png'
        ]);
        Discount::create([
            'place_id' => 2,
            'title' => 'خصم ٣٠٪',
            'content' => '٣٠٪',
            'discount' => '٣٠٪',
            'starting_date' => '2020-09-12',
            'end_date' => '2020-09-18',
            'image' => 'https://storage.googleapis.com/list-directory/images/biFQB76OBnHEZkGAOGuaphX9XJgyYPCyl5TeWkaf.png'
        ]);
    }
}