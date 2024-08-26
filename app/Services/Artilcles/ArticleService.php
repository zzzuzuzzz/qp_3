<?php

namespace App\Services\Artilcles;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Services\Articles\ArticleCreationServiceContract;
use App\Contracts\Services\Articles\ArticleRemoverServiceContract;
use App\Contracts\Services\Articles\ArticleUpdateServiceContract;
use App\Contracts\Services\ImagesServiceContract;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use App\Events\ArticleCreatedEvent;
use App\Events\ArticleUpdatedEvent;
use App\Events\ArticleDelitedEvent;

class ArticleService implements ArticleCreationServiceContract, ArticleUpdateServiceContract, ArticleRemoverServiceContract
{    
    public function __construct(
        private readonly ArticlesRepositoryContract $articlesRepository,
        private readonly ImagesServiceContract $imagesServiceContract,
    ) {
    }
    public function create(array $fields): Article
    {
        $article = $this->articlesRepository->getArticle();
        DB::transaction(function () use ($fields) {
            if (! empty($fields['image'])) {
                $image = $this->imagesServiceContract->createImage($fields['image']);
                $fields['image_id'] = $image->id;
            }
            $article = $this->articlesRepository->create($fields);
            $this->articlesRepository->flushCache();
            Event::dispatch(new ArticleCreatedEvent($article));
        }, 3);
        return $article;
    }

    public function update(int $id, array $fields): Article
    {
        $article = $this->articlesRepository->getById($id);
        DB::transaction(function () use ($fields, $article): void {
            $oldImageId = null;
            if (! empty($fields['image'])) {
                $image = $this->imagesServiceContract->createImage($fields['image']);
                $fields['image_id'] = $image->id;
                $oldImageId = $article->image_id;
            }
            $this->articlesRepository->update($article, $fields);
            if (! empty($oldImageId)) {
                $this->imagesServiceContract->deleteImage($oldImageId);
            }
            $this->articlesRepository->flushCache();
        }, 3);
        Event::dispatch(new ArticleUpdatedEvent($article));
        return $article;
    }
    public function delete(int $id)
    {
        $article = $this->articlesRepository->getById($id);
        if (! empty($article->image_id)) {
            $this->imagesServiceContract->deleteImage($article->image_id);
        }
        $this->articlesRepository->flushCache();
        $this->articlesRepository->delete($id);
        Event::dispatch(new ArticleDelitedEvent($article));
    }
}
