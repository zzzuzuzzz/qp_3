<?php

namespace App\Contracts\Services;

interface SalonsApiClientServiceContract
{
    /**
    * @throws RequestException
    */
    public function find(): array;
    /**
    * @throws RequestException
    */
    public function footer(int $limit = 2, bool $random = true): array;
}