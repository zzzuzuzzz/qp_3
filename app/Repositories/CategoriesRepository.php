<?php

namespace App\Repositories;

use App\Contracts\Repositories\CategoriesRepositoryContract;
use App\Models\Category;
use Illuminate\Support\Collection;

class CategoriesRepository implements CategoriesRepositoryContract
{
    public function __construct(private readonly Category $model)
    {
    }

    public function getTree(?int $maxDepth = null): Collection
    {
        return $this->getModel()
            ->withDepth()
            ->when($maxDepth, fn ($query) => $query->having('depth', '<=', $maxDepth))
            ->get()
            ->toTree();
    }
    public function getModel(): Category
    {
        return $this->model;
    }
    public function findAll(): Collection
    {
        return $this->getModel()->get();
    }
    public function findBySlug(string $slug, array $relations = []): Category
    {
        return $this->getModel()
            ->where('slug', $slug)
            ->when($relations, fn ($query) => $query->with($relations))
            ->firstOrFail();
    }
}
