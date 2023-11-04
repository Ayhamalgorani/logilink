<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = json_decode(file_get_contents(database_path('data/countries.json')), true);
        $countries_arr = array();
        foreach ($countries as $country){
            $countries_arr[] = [
                'name' => $country['name'],
                'code' => $country['code']
            ];
        }
        Country::query()->insert($countries_arr);

    }
}
