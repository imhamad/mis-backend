<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Country extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'name' => 'Pakistan',
                'code' => 'PK',
            ],
            [
                'name' => 'United States',
                'code' => 'US',
            ],
            [
                'name' => 'United Kingdom',
                'code' => 'UK',
            ],
            [
                'name' => 'China',
                'code' => 'CN',
            ]
        ];

        foreach ($countries as $country) {
            \App\Models\Country::create($country);
        }
    }
}
