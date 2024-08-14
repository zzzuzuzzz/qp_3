<?php

namespace App\Services;
use App\Contracts\Repositories\CarsRepositoryContract;
use App\Contracts\Services\CarCreationServiceContract;
use App\Contracts\Services\CarUpdateServiceContract;
use App\Models\Car;
class CarsService implements CarCreationServiceContract, CarUpdateServiceContract
{
    public function __construct(private readonly CarsRepositoryContract $carsRepository)
    {
    }
    public function create(array $fields, array $categories = []): Car
    {
        $car = $this->carsRepository->create($fields);
        if (! empty($categories)) {
            $this->carsRepository->syncCategories($car, $categories);
        }
        return $car;
    }

    public function update(int $id, array $fields, ?array $categories = null): Car
    {
        $car = $this->carsRepository->getById($id);
        $this->carsRepository->update($car, $fields);
        if ($categories !== null) {
            $this->carsRepository->syncCategories($car, $categories);
        }
        return $car;
    }
}
