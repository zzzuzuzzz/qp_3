<?php

namespace App\Services;

use App\Contracts\Services\SalonsApiClientServiceContract;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class SalonsApiClientService implements SalonsApiClientServiceContract
{
    public function __construct(
        private string $baseUrl,
        private string $user,
        private string $password
    ) {
    }

    private function getClient(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl)->withBasicAuth($this->user, $this->password);
    }
    /**
    * @throws RequestException
    */
    public function find(): array
    {
        return $this->getClient()->get('/salons')->throw()->json();
    }
    /**
    * @throws RequestException
    */
    public function footer(int $limit = 2, bool $random = true): array
    {
        $url = 'limit=' . $limit;
        if ($random) { 
            $url .= '&in_random_order';
        }
        return $this->getClient()->get('/salons?' . $url)->throw()->json();
    }
}