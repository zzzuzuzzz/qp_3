<?php

namespace App\Services;
use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Services\ArticlesDataCollectorServiceContract;
use App\DTO\ArticlesDataDTO;

class ArticlesDataCollectorService implements ArticlesDataCollectorServiceContract
{
    public function __construct(
        private readonly ArticlesRepositoryContract $articlesRepository,
    ) {
    }
    public function collectArticlesData(
        int $perPage = 10,
        int $page = 1,
        string $pageName = 'page',
    ): ArticlesDataDTO {
        $articles = $this->articlesRepository->paginateForArticles(
            ['id', 'title', 'description', 'published_at'],
            $perPage,
            $page,
            $pageName,
        );
        return new ArticlesDataDTO($articles);
    }
}
