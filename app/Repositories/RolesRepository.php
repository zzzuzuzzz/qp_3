<?php

namespace App\Repositories;

use App\Contracts\Repositories\RolesRepositoryContract;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RolesRepository implements RolesRepositoryContract
{
    public function __construct(private readonly Role $role, private readonly User $user, )
    {
    }
    
    public function hasRole(int $userId, string $role): bool
    {
        return $this->getUserRoleId($userId) == $this->getRoleId($role) ?? false;
    }
    private function getUserRoleId(int $userId): int|null
    {
        return $this->user->find($userId)->role;
    }
    private function getRoleId(string $name): int
    {
        return $this->role->where('name', $name)->limit(1)->first()->id;
    }
}