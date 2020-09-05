<?php

use App\Models\Government;
use App\Models\Governorate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $governs = ['درنته', 'فليفولاند'];
        $cities = ['أسن', 'ألميرا'];
        for ($i = 0; $i < sizeof($governs); $i++) {
            $govern = Governorate::create(['name' => $governs[$i]]);
            $govern->cities()->create(['name' => $cities[$i]]);
        }
    }
}