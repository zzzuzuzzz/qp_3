<?php

namespace Database\Factories;

use App\Contracts\Services\ImagesServiceContract;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /** @var ImagesServiceContract $imagesService */
        $imagesService = app(ImagesServiceContract::class);
        return [
            'path' => $imagesService->saveFile($this->faker->image(category: 'car')),
        ];
    }
}
