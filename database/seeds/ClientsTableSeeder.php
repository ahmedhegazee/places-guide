<?php

use App\Models\Client;
use App\User;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            [
                'name' => 'ahmed hegazy',
                'dob' => '1998-07-14',
                'password' => bcrypt('12345678'),
                'email' => 'ahmed@email.com',
                'phone' => '01113353945',
                'last_donation_date' => '2020-8-7',
                'city_id' => 98,
                'blood_type_id' => 1,
            ], [
                'name' => 'Khaled Ali',
                'dob' => '1990-08-16',
                'password' => bcrypt('12345678'),
                'email' => 'khaled@email.com',
                'phone' => '01113353940',
                'last_donation_date' => '2019-8-7',
                'city_id' => 99,
                'blood_type_id' => 1,
            ], [
                'name' => 'Waleed Salem',
                'dob' => '1999-01-01',
                'password' => bcrypt('12345678'),
                'email' => 'waleed@email.com',
                'phone' => '01113353942',
                'last_donation_date' => '2010-10-7',
                'city_id' => 98,
                'blood_type_id' => 1,
            ], [
                'name' => 'Mohammed Mohktar',
                'dob' => '2000-06-20',
                'password' => bcrypt('12345678'),
                'email' => 'mohamed@email.com',
                'phone' => '01113353947',
                'last_donation_date' => '2012-5-9',
                'city_id' => 99,
                'blood_type_id' => 1,
            ],

        ];
        for ($i = 0; $i < sizeOf($clients); $i++) {
            $client = Client::create($clients[$i]);
            if ($i != 0) {
                $client->bloodTypes()->attach([2, 3]);
                $client->governments()->attach([8, 4]);
            }
        }
        // User::create([
        //     'name' => 'ahmed hegazy',
        //     'email' => 'hegz@admin.com',
        //     'password' => bcrypt('password')
        // ]);
    }
}