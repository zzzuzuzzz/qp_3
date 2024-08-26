<?php

namespace App\Repositories\Cars;

use App\Contracts\Repositories\Cars\CarClassesRepositoryContract;
use App\Models\CarClass;
use Illuminate\Support\Collection;

class CarClassesRepository implements CarClassesRepositoryContract
{
    public function __construct(private readonly CarClass $model)
    {
    }
    public function findAll(): Collection
    {
        return $this->getModel()->get();
    }
    private function getModel(): CarClass
    {
        return $this->model;
    }
}
