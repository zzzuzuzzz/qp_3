<?php

namespace App\Contracts\Services\Articles;
use App\Models\Article;

interface ArticleUpdateServiceContract
{
    public function update(int $id, array $fields): Article;
}
