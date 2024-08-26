<?php

namespace Database\Seeders;

use App\Contracts\Services\ImagesServiceContract;
use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(ImagesServiceContract $imagesService): void
    {
        foreach ($this->banners() as $banner) {
            if (! empty($banner['image'])) {
                $image = $imagesService->createImage(resource_path($banner['image']));
                $banner['image_id'] = $image->id;
            }
            unset($banner['image']);
            Banner::factory()->create(array_merge($banner));
        }
    }

    private function banners(): array
    {
        return [
            [
                'image' => 'assets/pictures/test_banner_1.jpg',
            ],
            [
                'image' => 'assets/pictures/test_banner_2.jpg',
            ],
            [
                'image' => 'assets/pictures/test_banner_3.jpg',
            ]
        ];
    }
}
