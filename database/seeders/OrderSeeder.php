<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert(
            [
                "user_id" => 1,
                "service_id" => 1,
                "location" => 'amman',
                "time" => '19',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    asset('public/img/test.jpg'),
                ]),            
                ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 1,
                "service_id" => 1,
                "location" => 'amman',
                "time" => '19',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    asset('public/img/test.jpg'),

                ]),            
            ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 1,
                "service_id" => 2,
                "location" => 'amman',
                "time" => '19',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    asset('public/img/test.jpg'),

                ]),            
            ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 1,
                "service_id" => 2,
                "location" => 'amman',
                "time" => '19',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    asset('public/img/test.jpg'),

                ]),            
            ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 1,
                "service_id" => 3,
                "location" => 'amman',
                "time" => '19',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    asset('public/img/test.jpg'),

                ]),            
            ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 1,
                "service_id" => 3,
                "location" => 'amman',
                "time" => '19',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    asset('public/img/test.jpg'),

                ]),            
            ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 1,
                "service_id" => 4,
                "location" => 'amman',
                "time" => '19',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    asset('public/img/test.jpg'),

                ]),            
            ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 1,
                "service_id" => 4,
                "location" => 'amman',
                "time" => '19',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    asset('public/img/test.jpg'),

                ]),            
            ]
        );
    }
}