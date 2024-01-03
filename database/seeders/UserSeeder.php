<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                "name" => "admin",
                "email" => "admin@admin.com",
                "password" => Hash::make('password'),
            ]
        );
        // user
        DB::table('users')->insert(
            [
                "name" => "ayham",
                "email" => "ayham@admin.com",
                "password" => Hash::make('password'),
                "gender" => 'male',
                "phone_number" => '0796943945',
                "is_worker" => 0,
            ]
        );
        // worker
        DB::table('users')->insert(
            [

                "service_id" =>1,
                "name" => "worker",
                "email" => "worker@worker.com",
                "password" => Hash::make('password'),
                "gender" => 'male',
                "phone_number" => '0796943941',
                "is_worker" => 1,
            ]
        );
    }
}