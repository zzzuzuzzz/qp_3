<?php

namespace App\Contracts\Repositories;

use App\Models\Article;

interface StatisticsRepositoryContract
{
    public function getCarsCount(): int;
    public function getArticlesCount(): int;
    public function getPopularTag(): string;
    public function getLongArticle(): Article;
    public function getShortArticle(): Article;
    public function avgArticlesForTags(): int;
    public function mostTaggedArticle(): Article;
}
