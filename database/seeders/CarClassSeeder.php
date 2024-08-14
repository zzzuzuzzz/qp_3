<?php

namespace Database\Seeders;

use App\Models\CarClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            'Бюджет',
            'Бизнес-класс',
            'Представительский класс',
            'Люкс',
        ];
        foreach ($classes as $class) {
            CarClass::factory()->create(['name' => $class]);
        }
    }
}
