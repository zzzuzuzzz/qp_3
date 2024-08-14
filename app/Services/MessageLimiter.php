<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Contracts\Services\MessageLimiterContract;
class MessageLimiter implements MessageLimiterContract
{
    public function limit(string $message, int $limit = 20, string $end = '...'):
    string
    {
        return Str::limit($message, $limit, $end);
    }
}
