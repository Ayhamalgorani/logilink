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
                "user_id" => 2,
                "service_id" => 1,
                "location" => 'amman',
                "time" => '1',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    '1sZm0oM5wDyXuKbgp4DFqF48fJyKiBr0fE4kWZ48.jpg',
                ]),            
                ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 2,
                "service_id" => 2,
                "location" => 'amman',
                "time" => '2',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    '1sZm0oM5wDyXuKbgp4DFqF48fJyKiBr0fE4kWZ48.jpg',

                ]),            
            ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 2,
                "service_id" => 3,
                "location" => 'amman',
                "time" => '3',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    '1sZm0oM5wDyXuKbgp4DFqF48fJyKiBr0fE4kWZ48.jpg',

                ]),            
            ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 2,
                "service_id" => 4,
                "location" => 'amman',
                "time" => '4',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    '1sZm0oM5wDyXuKbgp4DFqF48fJyKiBr0fE4kWZ48.jpg',

                ]),            
            ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 2,
                "service_id" => 5,
                "location" => 'amman',
                "time" => '5',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    '1sZm0oM5wDyXuKbgp4DFqF48fJyKiBr0fE4kWZ48.jpg',

                ]),            
            ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 2,
                "service_id" => 6,
                "location" => 'amman',
                "time" => '6',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    '1sZm0oM5wDyXuKbgp4DFqF48fJyKiBr0fE4kWZ48.jpg',

                ]),            
            ]
        );
        
        DB::table('orders')->insert(
            [
                "user_id" => 3,
                "service_id" => 1,
                "location" => 'amman',
                "time" => '7',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    '1sZm0oM5wDyXuKbgp4DFqF48fJyKiBr0fE4kWZ48.jpg',
                ]),            
                ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 3,
                "service_id" => 2,
                "location" => 'amman',
                "time" => '8',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    '1sZm0oM5wDyXuKbgp4DFqF48fJyKiBr0fE4kWZ48.jpg',

                ]),            
            ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 3,
                "service_id" => 3,
                "location" => 'amman',
                "time" => '9',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    '1sZm0oM5wDyXuKbgp4DFqF48fJyKiBr0fE4kWZ48.jpg',

                ]),            
            ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 3,
                "service_id" => 4,
                "location" => 'amman',
                "time" => '10',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    '1sZm0oM5wDyXuKbgp4DFqF48fJyKiBr0fE4kWZ48.jpg',
                ]),            
            ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 3,
                "service_id" => 5,
                "location" => 'amman',
                "time" => '11',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    '1sZm0oM5wDyXuKbgp4DFqF48fJyKiBr0fE4kWZ48.jpg', 

                ]),            
            ]
        );
        DB::table('orders')->insert(
            [
                "user_id" => 3,
                "service_id" => 6,
                "location" => 'amman',
                "time" => '19',
                "date" => '2015-05-17',
                "description" => 'test test',
                'images' => json_encode([
                    '1sZm0oM5wDyXuKbgp4DFqF48fJyKiBr0fE4kWZ48.jpg',

                ]),            
            ]
        );
       
      
    }
}