<?php

namespace App\Contracts\Repositories;

use App\Models\Category;
use Illuminate\Support\Collection;
use App\Contracts\Repositories\FlushCacheRepositoryContract;

interface CategoriesRepositoryContract extends FlushCacheRepositoryContract
{
    public function getTree(?int $maxDepth = null): Collection;
    public function findAll(): Collection;
    public function findBySlug(string $slug, array $relations = []): Category;
}
