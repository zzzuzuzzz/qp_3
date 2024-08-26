<?php

namespace App\Contracts\Services\Cars;
use App\Models\Car;

interface CarUpdateServiceContract
{
    public function update(int $id, array $fields, ?array $categories = null): Car;
}
