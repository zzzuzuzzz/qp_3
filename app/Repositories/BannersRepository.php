<?php

namespace App\Repositories;

use App\Contracts\Repositories\BannersRepositoryContract;
use App\Models\Banner;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class BannersRepository implements BannersRepositoryContract
{
    use FlushesCache;

    protected function cacheTags(): array
    {
        return ['banners'];
    }
    public function __construct(private readonly Banner $banner)
    {
    }
    public function findForMainPage(int $limit): Collection
    {
        return Cache::tags(['banners', 'images'])->remember(
            "mainPageBanners|$limit",
            3600,
            fn () => $this->getBanner()->limit($limit)->with('image')->get()
        );
    }
    public function getBanner(): Banner
    {
        return $this->banner;
    }
    public function paginateForBanners(
        array $fields = ['*'],
        int $perPage = 10,
        int $page = 1,
        string $pageName = 'page',
        array $relations = []
    ): LengthAwarePaginator {
        return Cache::tags(['banners', 'images'])->remember(
            sprintf(
                'paginateForBanners|%s',
                serialize([
                    'fields' => $fields,
                    'perPage' => $perPage,
                    'page' => $page,
                    'pageName' => $pageName,
                    'relations' => $relations,
                ])
            ),
            3600,
            fn () =>
            $this->getBanner()->with($relations)->paginate($perPage, $fields, $pageName, $page)
        );
    }
}
