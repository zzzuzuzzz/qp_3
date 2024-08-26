<?php

namespace App\Services\Cars;

use App\Contracts\Repositories\Cars\CarsRepositoryContract;
use App\Contracts\Services\Cars\CarCreationServiceContract;
use App\Contracts\Services\Cars\CarRemoverServiceContract;
use App\Contracts\Services\Cars\CarUpdateServiceContract;
use App\Contracts\Services\ImagesServiceContract;
use App\Models\Car;

class CarsService implements CarCreationServiceContract, CarRemoverServiceContract, CarUpdateServiceContract
{
    public function __construct(
        private readonly CarsRepositoryContract $carsRepository,
        private readonly ImagesServiceContract $imagesServiceContract
    ) {
    }
    public function create(array $fields, array $categories = []): Car
    {
        if (! empty($fields['image'])) {
            $image = $this->imagesServiceContract->createImage($fields['image']);
            $fields['image_id'] = $image->id;
        }
        $car = $this->carsRepository->create($fields);
        if (! empty($categories)) {
            $this->carsRepository->syncCategories($car, $categories);
        }
        $this->carsRepository->flushCache();
        return $car;
    }

    public function update(int $id, array $fields, ?array $categories = null): Car
    {
        $car = $this->carsRepository->getById($id);
        $oldImageId = null;
        if (! empty($fields['image'])) {
            $image = $this->imagesServiceContract->createImage($fields['image']);
            $fields['image_id'] = $image->id;
            $oldImageId = $car->image_id;
        }
        $this->carsRepository->update($car, $fields);
        if (! empty($oldImageId)) {
            $this->imagesServiceContract->deleteImage($oldImageId);
        }
        if ($categories !== null) {
            $this->carsRepository->syncCategories($car, $categories);
        }
        $this->carsRepository->flushCache();
        return $car;
    }
    public function delete(int $id)
    {
        $car = $this->carsRepository->getById($id);
        if (! empty($car->image_id)) {
            $this->imagesServiceContract->deleteImage($car->image_id);
        }
        $this->carsRepository->delete($id);
        $this->carsRepository->flushCache();
    }
}
