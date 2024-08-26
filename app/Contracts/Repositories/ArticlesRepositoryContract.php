<?php

namespace App\Contracts\Repositories;

use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ArticlesRepositoryContract
{
    public function getArticle(): Article;
    public function findAll(): Collection;
    public function create(array $fields): Article;

    public function update(Article $article, array $fields): Article;

    public function delete(int $id): void;

    public function findForMainPage(int $limit): Collection;
    public function articlesPage(): Collection;
    public function getById(int $id): Article;

    public function paginateForArticles(
        array $fields = ['*'],
        int $perPage = 10,
        int $page = 1,
        string $pageName = 'page',
        array $relations = [],
    ): LengthAwarePaginator;
}
