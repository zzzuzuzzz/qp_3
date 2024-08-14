<?php

namespace App\Repositories;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Repositories\CarsRepositoryContract;
use App\Models\Article;
use App\Models\Car;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
class ArticlesRepository implements ArticlesRepositoryContract
{
    public function __construct(private readonly Article $article)
    {
    }
    public function findAll(): Collection
    {
        return $this->getArticle()->get();
    }
    public function findForMainPage(int $limit): Collection
    {
        return $this->getArticle()->where('published_at', '!=', null)->limit($limit)->get();
    }
    public function articlesPage(): Collection
    {
        return $this->getArticle()->where('published_at', '!=', null)->get();
    }

    public function getById(int $id): Article
    {
        return $this
            ->getArticle()
            ->findOrFail($id);
    }
    public function create(array $fields): Article
    {
        $article = $this->getArticle()->create($fields);
        return $article;
    }
    public function getArticle(): Article
    {
        return $this->article;
    }

    public function paginateForArticles(array $fields = ['*'], int $perPage = 10, int $page = 1, string $pageName = 'page'): LengthAwarePaginator
    {
        return $this->getArticle()->paginate($perPage, $fields, $pageName, $page);;
    }
}
