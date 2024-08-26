<?php

namespace App\Services;

use App\Contracts\Services\Flash\MessageLimiterContract;
use Illuminate\Support\Str;

class MessageLimiter implements MessageLimiterContract
{
    public function limit(string $message, int $limit = 20, string $end = '...'):
    string
    {
        return Str::limit($message, $limit, $end);
    }
}
