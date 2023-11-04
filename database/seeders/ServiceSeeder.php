<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert(
            [
                "name" => "Electricity"
            ]
        );
        DB::table('services')->insert(
            [
                "name" => "Cleaning"
            ]
        );
        DB::table('services')->insert(
            [
                "name" => "Plumbing"
            ]
        );
        DB::table('services')->insert(
            [
                "name" => "Painting"
            ]
        );
        DB::table('services')->insert(
            [
                "name" => "Carprntry"
            ]
        );
        DB::table('services')->insert(
            [
                "name" => "Gardining"
            ]
        );
       
    }
}
