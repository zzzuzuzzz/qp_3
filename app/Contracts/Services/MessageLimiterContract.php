<?php

namespace App\Contracts\Services;
interface MessageLimiterContract
{
    public function limit(string $message, int $limit = 20, string $end = '...'):
    string;
}
