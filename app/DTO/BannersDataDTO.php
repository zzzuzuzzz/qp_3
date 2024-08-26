<?php

namespace App\DTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BannersDataDTO
{
    public function __construct(
        public readonly LengthAwarePaginator $articles,
    ) {
    }
}
