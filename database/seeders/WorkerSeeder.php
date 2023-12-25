<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Worker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('workers')->insert(
            [
                'service_id' =>1,
                    'user_id' =>2,
                    'name' => 'Worker ',
                    'email' => 'worker' . '@gmail.com',
                    'birth_date' => '1990-01-01',
                    'gender' => 'Male',
                    'phone_number' => '1234567890',
                    'location' => 'Sample Location',
            ]
        );
    }
}