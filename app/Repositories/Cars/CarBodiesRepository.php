<?php

namespace App\Repositories\Cars;

use App\Contracts\Repositories\Cars\CarBodiesRepositoryContract;
use App\Models\CarBody;
use Illuminate\Support\Collection;

class CarBodiesRepository implements CarBodiesRepositoryContract
{
    public function __construct(private readonly CarBody $model)
    {
    }
    public function findAll(): Collection
    {
        return $this->getModel()->get();
    }
    private function getModel(): CarBody
    {
        return $this->model;
    }
}
