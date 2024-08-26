<?php

namespace App\Repositories;

use App\Contracts\Repositories\StatisticsRepositoryContract;
use App\Models\Article;
use App\Models\Car;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class StatisticsRepository implements StatisticsRepositoryContract
{
    public function getCarsCount(): int
    {
        return Car::count();
    }
    public function getArticlesCount(): int
    {
        return Article::count();
    }
    public function getPopularTag(): string
    {
        $tag = Tag::find(DB::table('taggables')
        ->where('taggable_type', Article::class)
        ->get()
        ->groupBy('tag_id')
        ->max()
        ->first()
        ->tag_id);

        return $tag->name; 
    }
    public function getLongArticle(): Article
    {
        return Article::select('id', 'title', DB::raw('LENGTH(body) as body_length'))->orderBy('body_length', 'desc')->first();
    }
    public function getShortArticle(): Article
    {
        return Article::select('id', 'title', DB::raw('LENGTH(body) as body_length'))->orderBy('body_length', 'asc')->first();
    }
    public function avgArticlesForTags(): int
    {
        return DB::table('taggables')
        ->select('tag_id', DB::raw('count(*) as total'))
        ->where('taggable_type', Article::class)
        ->groupBy('tag_id')
        ->having('total', '>', 0)
        ->average('total');
    }
    public function mostTaggedArticle(): Article
    {
        $tags = DB::table('taggables')
            ->where('taggable_type', Article::class)
            ->get()
            ->groupBy('taggable_id')
            ->max();

        $article = Article::find($tags->first()->taggable_id);
        $article->total_tags = $tags->count();

        return $article;
    }
}
