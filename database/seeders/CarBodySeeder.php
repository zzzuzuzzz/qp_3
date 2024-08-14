<?php

namespace Database\Seeders;

use App\Models\CarBody;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarBodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bodies = [
            'Седан',
            'Хетчбек',
            'Универсал',
            'Купе',
            'Родстер',
            'Внедорожник',
            'Рамный',
            'Пикап',
            'Кроссовер',
        ];
        foreach ($bodies as $body) {
            CarBody::factory()->create(['name' => $body]);
        }
    }
}
