<?php

namespace App\Services\Artilcles;
use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Services\Articles\ArticlesDataCollectorServiceContract;
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
            ['id', 'title', 'description', 'published_at', 'image_id'],
            $perPage,
            $page,
            $pageName,
            ['image']
        );
        return new ArticlesDataDTO($articles);
    }
}
