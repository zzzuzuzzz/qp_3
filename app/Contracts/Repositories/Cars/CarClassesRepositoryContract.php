<?php

namespace App\Contracts\Repositories\Cars;

use Illuminate\Support\Collection;

interface CarClassesRepositoryContract
{
    public function findAll(): Collection;
}
