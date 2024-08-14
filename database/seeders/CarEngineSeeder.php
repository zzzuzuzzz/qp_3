<?php

namespace Database\Seeders;

use App\Models\CarEngine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarEngineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarEngine::factory()->count(10)->create();
    }
}
