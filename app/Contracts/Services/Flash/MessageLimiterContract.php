<?php

namespace App\Contracts\Services\Flash;
interface MessageLimiterContract
{
    public function limit(string $message, int $limit = 20, string $end = '...'):
    string;
}
