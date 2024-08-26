<?php

namespace App\Contracts\Services\Articles;

interface ArticleRemoverServiceContract
{
    public function delete(int $id);
}
