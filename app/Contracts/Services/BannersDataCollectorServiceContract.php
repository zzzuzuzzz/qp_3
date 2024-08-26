<?php

namespace App\Contracts\Services;
use App\DTO\BannersDataDTO;


interface BannersDataCollectorServiceContract
{
    public function collectBannersData(
        int $perPage = 10,
        int $page = 1,
        string $pageName = 'page',
    ): BannersDataDTO;
}
