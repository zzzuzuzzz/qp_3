<?php

namespace App\Providers;

use App\Contracts\Services\ArticlesDataCollectorServiceContract;
use App\Contracts\Services\CarCreationServiceContract;
use App\Contracts\Services\CarUpdateServiceContract;
use App\Contracts\Services\FlashMessageContract;
use App\Contracts\Services\MessageLimiterContract;
use App\Contracts\Services\TagsSynchronizerServiceContract;
use App\Services\ArticlesDataCollectorService;
use App\Services\CarsService;
use App\Services\FlashMessage;
use App\Services\MessageLimiter;
use App\Services\TagsSynchronizerService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\CatalogDataCollectorServiceContract;
use App\Services\CatalogDataCollectorService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TagsSynchronizerServiceContract::class, TagsSynchronizerService::class);
        $this->app->singleton(CatalogDataCollectorServiceContract::class, CatalogDataCollectorService::class);
        $this->app->singleton(ArticlesDataCollectorServiceContract::class, ArticlesDataCollectorService::class);
        $this->app->singleton(CarUpdateServiceContract::class, CarsService::class);
        $this->app->singleton(CarCreationServiceContract::class, CarsService::class);
        $this->app->singleton(FlashMessageContract::class, FlashMessage::class);
        $this->app->singleton(FlashMessage::class, fn () => new FlashMessage($this->app->make(MessageLimiterContract::class), session()));
        $this->app->singleton(MessageLimiterContract::class, MessageLimiter::class);
        $this->app->singleton(MessageLimiterContract::class, fn () => new class implements MessageLimiterContract {
            public function limit(string $message, int $limit = 20, string $end = '...'): string
            {
                return $message;
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('admin', fn () => true);
    }
}
