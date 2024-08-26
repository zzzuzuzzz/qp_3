<?php

namespace App\Repositories;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ArticlesRepository implements ArticlesRepositoryContract
{
    use FlushesCache;

    protected function cacheTags(): array
    {
        return ['articles'];
    }
    public function __construct(private readonly Article $article)
    {
    }
    public function findAll(): Collection
    {
        return $this->getArticle()->get();
    }
    public function findForMainPage(int $limit): Collection
    {
        return Cache::tags(['articles', 'images'])->remember(
            "mainPageArticles|$limit",
            3600,
            fn () => $this->getArticle()->where('published_at', '!=', null)->with('image')->limit($limit)->get()
        );
    }
    public function articlesPage(): Collection
    {
        return $this->getArticle()->where('published_at', '!=', null)->get();
    }

    public function getById(int $id, array $relations = []): Article
    {
        return Cache::remember(
            sprintf('articleById|%s|%s', $id, implode('|', $relations)),
            3600,
            fn () => $this->getArticle()
                ->when($relations, fn ($query) => $query->with($relations))
                ->findOrFail($id)
        );
    }
    public function create(array $fields): Article
    {
        $article = $this->getArticle()->create($fields);
        return $article;
    }
    public function update(Article $article, array $fields): Article
    {
        $article->update($fields);
        return $article;
    }
    public function delete(int $id): void
    {
        $this->getArticle()->where('id', $id)->delete();
    }
    public function getArticle(): Article
    {
        return $this->article;
    }

    public function paginateForArticles(
        array $fields = ['*'],
        int $perPage = 10,
        int $page = 1,
        string $pageName = 'page',
        array $relations = []
    ): LengthAwarePaginator {
        return Cache::tags(['articles', 'images'])->remember(
            sprintf(
                'paginateForArticles|%s',
                serialize([
                    'fields' => $fields,
                    'perPage' => $perPage,
                    'page' => $page,
                    'pageName' => $pageName,
                    'relations' => $relations,
                    ])
            ),
            3600,
            fn () =>
            $this->getArticle()->with($relations)->paginate($perPage, $fields, $pageName, $page)
        );
    }
}
