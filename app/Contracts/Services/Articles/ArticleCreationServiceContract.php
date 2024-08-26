<?php

namespace App\Contracts\Services\Articles;
use App\Models\Article;

interface ArticleCreationServiceContract
{
    public function create(array $fields): Article;
}
