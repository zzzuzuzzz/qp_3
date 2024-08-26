<?php

namespace App\Services;
use App\Contracts\Repositories\BannersRepositoryContract;
use App\Contracts\Services\BannersDataCollectorServiceContract;
use App\DTO\BannersDataDTO;

class BannersDataCollectorService implements BannersDataCollectorServiceContract
{
    public function __construct(
        private readonly BannersRepositoryContract $bannersRepository,
    ) {
    }
    public function collectBannersData(
        int $perPage = 10,
        int $page = 1,
        string $pageName = 'page',
    ): BannersDataDTO {
        $banners = $this->bannersRepository->paginateForBanners(
            ['id', 'title', 'description', 'published_at', 'image_id'],
            $perPage,
            $page,
            $pageName,
            ['image']
        );
        return new BannersDataDTO($banners);
    }
}
