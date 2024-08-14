<?php

namespace App\Services;

use Illuminate\Session\SessionManager;
use Illuminate\Session\Store;
use Illuminate\Support\Collection;
use App\Contracts\Services\FlashMessageContract;
use App\Contracts\Services\MessageLimiterContract;

class FlashMessage implements FlashMessageContract
{
    public function __construct(
        private readonly MessageLimiterContract $messageLimiter,
        private readonly SessionManager | Store $store
    ) {
    }

    public function success(string|array $messages): void
    {
        $this->flash('success_messages', collect((array)$messages));
    }
    public function error(string|array $messages): void
    {
        $this->flash('error_messages', collect((array)$messages));
    }
    public function successMessages(): Collection
    {
        return $this->store->get('success_messages', collect());
    }
    public function errorMessages(): Collection
    {
        return $this->store->get('error_messages', collect());
    }

    private function flash(string $type, Collection $messages): void
    {
        $this->store->flash($type, $messages->map(fn ($message) =>
        $this->messageLimiter->limit($message)));
    }
    private function storage(): SessionManager|Store
    {
        return session();
    }
}
