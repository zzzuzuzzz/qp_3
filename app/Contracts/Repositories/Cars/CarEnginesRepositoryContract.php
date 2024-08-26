<?php

namespace App\Contracts\Repositories\Cars;

use Illuminate\Support\Collection;

interface CarEnginesRepositoryContract
{
    public function findAll(): Collection;
}
