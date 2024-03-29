<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(ContactUsSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(NotificationSeeder::class);

    }
}