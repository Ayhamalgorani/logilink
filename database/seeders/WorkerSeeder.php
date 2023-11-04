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
        $services = Service::all();
        Worker::query()->truncate();
        foreach ($services as $service) {
            for ($i = 0; $i < 6; $i++) {

                DB::table('workers')->insert([
                    'service_id' => ($service->id)+$i,
                    'name' => 'Worker ' . $i,
                    'email' => 'worker' . $i . '@gmail.com',
                    'birth_date' => '1990-01-01',
                    'gender' => 'Male',
                    'phone_number' => '1234567890',
                    'location' => 'Sample Location',
                ]);
            }
            break;
        }
    }
}
