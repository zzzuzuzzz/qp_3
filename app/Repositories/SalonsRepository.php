<?php

namespace App\Repositories;

use App\Contracts\Repositories\SalonsRepositoryContract;
use App\Contracts\Services\SalonsApiClientServiceContract;
use App\DTO\ApiSalonModel;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SalonsRepository implements SalonsRepositoryContract
{
    use FlushesCache;

    public function __construct(private readonly SalonsApiClientServiceContract $apiClient)
    {
    }
    
    public function find(): Collection
    {
        try {
            return Cache::tags($this->cacheTags())->remember('salons', 3600, function () {
                $salons = collect();
    
                foreach ($this->apiClient->find() as $salon) {
                    $salons->push($this->createModelFromResponseItem($salon));
                }
            
                return $salons;
            });
        } catch (RequestException $exception) {
            return collect();
        }
    }

    public function footer(int $limit = 2, bool $random = true): Collection
    {
        try {
            return Cache::tags($this->cacheTags())->remember('footerSalons', 300, function () {
                $salons = collect();
            
                foreach ($this->apiClient->footer() as $salon) {
                    $salons->push($this->createModelFromResponseItem($salon));
                }
            
                return $salons;
            });
        } catch (RequestException $exception) {
            return collect();
        }
    }

    private function createModelFromResponseItem(array $salon): ApiSalonModel
    {
        return new ApiSalonModel(
            $salon['name'],
            $salon['image'],
            $salon['address'],
            $salon['phone'],
            $salon['work_hours'],
            );
    }

    protected function cacheTags(): array
    {
        return ['api-salons'];
    }
}