<?php

namespace App\Contracts\Services\Articles;
use App\DTO\ArticlesDataDTO;


interface ArticlesDataCollectorServiceContract
{
    public function collectArticlesData(
        int $perPage = 10,
        int $page = 1,
        string $pageName = 'page',
    ): ArticlesDataDTO;
}
