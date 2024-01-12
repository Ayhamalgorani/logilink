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
                "birth_date" => "2015-05-17",
                "location" => 'amman',
                "email" => "ayham@admin.com",
                "password" => Hash::make('password'),
                "gender" => 'male',
                "phone_number" => '0796943945',
                "is_worker" => 0,
                "is_terms_agreed" => 1,
            ]
        );
        DB::table('users')->insert(
            [
                "name" => "test",
                "birth_date" => "2015-05-17",
                "email" => "test@test.com",
                "location" => 'amman',
                "password" => Hash::make('password'),
                "gender" => 'male',
                "phone_number" => '0796963945',
                "is_worker" => 0,
                "is_terms_agreed" => 1,

            ]
        );
        // worker
        DB::table('users')->insert(
            [

                "service_id" =>1,
                "name" => "worker1",
                "email" => "worker1@worker.com",
                "password" => Hash::make('password'),
                "gender" => 'male',
                "phone_number" => '0796943941',
                "is_worker" => 1,
            ]
        );
        DB::table('users')->insert(
            [

                "service_id" =>1,
                "name" => "worker2",
                "email" => "worker2@worker.com",
                "password" => Hash::make('password'),
                "gender" => 'male',
                "phone_number" => '0796943901',
                "is_worker" => 1,
            ]
        );
        DB::table('users')->insert(
            [

                "service_id" =>2,
                "name" => "worker3",
                "email" => "worker3@worker.com",
                "password" => Hash::make('password'),
                "gender" => 'male',
                "phone_number" => '0796933941',
                "is_worker" => 1,
            ]
        );
        DB::table('users')->insert(
            [

                "service_id" =>2,
                "name" => "worker4",
                "email" => "worker4@worker.com",
                "password" => Hash::make('password'),
                "gender" => 'male',
                "phone_number" => '0796983941',
                "is_worker" => 1,
            ]
        );
        DB::table('users')->insert(
            [

                "service_id" =>3,
                "name" => "worker5",
                "email" => "worker5@worker.com",
                "password" => Hash::make('password'),
                "gender" => 'male',
                "phone_number" => '0796543941',
                "is_worker" => 1,
            ]
        );
        DB::table('users')->insert(
            [

                "service_id" =>3,
                "name" => "worker6",
                "email" => "worker6@worker.com",
                "password" => Hash::make('password'),
                "gender" => 'male',
                "phone_number" => '0796643941',
                "is_worker" => 1,
            ]
        );
        DB::table('users')->insert(
            [

                "service_id" =>4,
                "name" => "worker7",
                "email" => "worker7@worker.com",
                "password" => Hash::make('password'),
                "gender" => 'male',
                "phone_number" => '0776943941',
                "is_worker" => 1,
            ]
        );
        DB::table('users')->insert(
            [

                "service_id" =>4,
                "name" => "worker8",
                "email" => "worker8@worker.com",
                "password" => Hash::make('password'),
                "gender" => 'male',
                "phone_number" => '0786943941',
                "is_worker" => 1,
            ]
        );
    }
}