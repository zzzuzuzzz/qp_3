<?php

namespace App\DTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticlesDataDTO
{
    public function __construct(
        public readonly LengthAwarePaginator $articles,
    ) {
    }
}
