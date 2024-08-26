<?php

namespace App\Contracts\Repositories;

use App\Models\Article;
use App\Models\Banner;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BannersRepositoryContract
{
    public function getBanner(): Banner;
    public function findForMainPage(int $limit): Collection;
    public function paginateForBanners(
        array $fields = ['*'],
        int $perPage = 10,
        int $page = 1,
        string $pageName = 'page',
        array $relations = [],
    ): LengthAwarePaginator;
}
