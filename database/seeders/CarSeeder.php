<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarBody;
use App\Models\CarClass;
use App\Models\CarEngine;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Collection $carClasses */
        $carClasses = CarClass::get();
        /** @var Collection $carEngines */
        $carEngines = CarEngine::get();
        /** @var Collection $carBodies */
        $carBodies = CarBody::get();
        /** @var Collection $categories */
        $categories = Category::get();

        foreach ($this->cars() as $car) {
            $carModel = Car::factory()->create(array_merge($car, [
                'class_id' => $carClasses->random(),
                'engine_id' => $carEngines->random(),
                'body_id' => $carBodies->random(),
            ]));
            $carModel->categories()->attach($categories->random(rand(1, 3)));
        }
    }

    private function cars(): array
    {
        return [
            [
                'name' => 'Seed',
                'price' => $price = 1394900,
                'old_price' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
            ],
            [
                'name' => 'Cerato',
                'price' => $price = 1221900,
                'old_price' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
            ],
            [
                'name' => 'K5',
                'price' => $price = 1577900,
                'old_price' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
            ],
            [
                'name' => 'K900',
                'price' => $price = 4064900,
                'old_price' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
            ],
            [
                'name' => 'Mohave',
                'price' => $price = 3549900,
                'old_price' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
            ],
            [
                'name' => 'Stinger',
                'price' => $price = 2409900,
                'old_price' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
            ],
            [
                'name' => 'Rio',
                'price' => $price = 969900,
                'old_price' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
            ],
            [
                'name' => 'Rio',
                'price' => $price = 849900,
                'old_price' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
            ],
            [
                'name' => 'Seltos',
                'price' => $price = 1224900,
                'old_price' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
            ],
            [
                'name' => 'Sorento',
                'price' => $price = 2219900,
                'old_price' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
            ],
            [
                'name' => 'Soul',
                'price' => $price = 1094900,
                'old_price' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
            ],
            [
                'name' => 'Sportage',
                'price' => $price = 1644900,
                'old_price' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
            ],
            [
                'name' => 'XSeed',
                'price' => $price = 1714900,
                'old_price' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
            ],
            [
                'name' => 'Some Car',
                'price' => 9999999,
                'old_price' => null,
            ],
        ];
    }
}
