<?php

namespace App\Contracts\Repositories\Cars;

use Illuminate\Support\Collection;

interface CarBodiesRepositoryContract
{
    public function findAll(): Collection;
}
