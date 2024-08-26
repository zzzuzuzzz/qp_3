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
        $this->call([
            CarClassSeeder::class,
            CarEngineSeeder::class,
            CarBodySeeder::class,
        ]);
        $this->call(CategorySeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(CarSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(UserSeeder::class);
    }
}
