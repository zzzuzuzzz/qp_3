<?php

namespace App\Policies;

use App\Contracts\Services\RolesServiceContract;
use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;
    
    public function __construct(private readonly RolesServiceContract $rolesService)
    {
    }
    
    public function viewAny(User $user)
    {
        return $this->rolesService->userIsAdmin($user->id);
    }
    
    public function view(User $user, Article $article)
    {
        return $this->rolesService->userIsAdmin($user->id);
    }
    
    public function create(User $user)
    {
        return $this->rolesService->userIsAdmin($user->id);
    }
    
    public function update(User $user, Article $article)
    {
        return $this->rolesService->userIsAdmin($user->id);
    }
    
    public function delete(User $user, Article $article)
    {
        return $this->rolesService->userIsAdmin($user->id);
    }
}
