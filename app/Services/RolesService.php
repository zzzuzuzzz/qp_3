<?php

namespace App\Services;

use App\Contracts\Repositories\RolesRepositoryContract;
use App\Contracts\Services\RolesServiceContract;

class RolesService implements RolesServiceContract
{
    public function __construct(private readonly RolesRepositoryContract $rolesRepository)
    {
    }

    public function userIsAdmin(int $userId): bool
    {
        return $this->rolesRepository->hasRole($userId, 'admin');
    }
}