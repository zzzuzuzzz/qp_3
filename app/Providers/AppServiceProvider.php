<?php

namespace App\Providers;

use App\Contracts\Services\Articles\ArticleCreationServiceContract;
use App\Contracts\Services\Articles\ArticleRemoverServiceContract;
use App\Contracts\Services\Articles\ArticlesDataCollectorServiceContract;
use App\Contracts\Services\Articles\ArticleUpdateServiceContract;
use App\Contracts\Services\BannersDataCollectorServiceContract;
use App\Contracts\Services\Cars\CarCreationServiceContract;
use App\Contracts\Services\Cars\CarRemoverServiceContract;
use App\Contracts\Services\Cars\CarUpdateServiceContract;
use App\Contracts\Services\Cars\CatalogDataCollectorServiceContract;
use App\Contracts\Services\Flash\FlashMessageContract;
use App\Contracts\Services\Flash\MessageLimiterContract;
use App\Contracts\Services\ImagesServiceContract;
use App\Contracts\Services\RolesServiceContract;
use App\Contracts\Services\SalonsApiClientServiceContract;
use App\Contracts\Services\StatisticsServiceContract;
use App\Contracts\Services\TagsSynchronizerServiceContract;
use App\Models\Article;
use App\Models\Car;
use App\Models\User;
use App\Policies\ArticlePolicy;
use App\Policies\CarPolicy;
use App\Services\Artilcles\ArticlesDataCollectorService;
use App\Services\Artilcles\ArticleService;
use App\Services\BannersDataCollectorService;
use App\Services\Cars\CarsService;
use App\Services\Cars\CatalogDataCollectorService;
use App\Services\FlashMessage;
use App\Services\ImagesService;
use App\Services\MessageLimiter;
use App\Services\RolesService;
use App\Services\SalonsApiClientService;
use App\Services\StatisticsService;
use App\Services\TagsSynchronizerService;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use QSchool\FakerImageProvider\FakerImageProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //------------------- Изображения -------------------
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create(Config::get('app.faker_locale', 'en_US'));
            $faker->addProvider(new FakerImageProvider($faker));
            return $faker;
        });
        $this->app->singleton(ImagesServiceContract::class, function () {
            return $this->app->make(ImagesService::class, ['disk' => 'public']);
        });

        //------------------- Машины -------------------
        $this->app->singleton(CarRemoverServiceContract::class, CarsService::class);
        $this->app->singleton(CatalogDataCollectorServiceContract::class, CatalogDataCollectorService::class);
        $this->app->singleton(CarUpdateServiceContract::class, CarsService::class);
        $this->app->singleton(CarCreationServiceContract::class, CarsService::class);

        //------------------- Новости -------------------
        $this->app->singleton(ArticlesDataCollectorServiceContract::class, ArticlesDataCollectorService::class);
        $this->app->singleton(ArticleCreationServiceContract::class, ArticleService::class);
        $this->app->singleton(ArticleUpdateServiceContract::class, ArticleService::class);
        $this->app->singleton(ArticleRemoverServiceContract::class, ArticleService::class);

        //------------------- Сообщения -------------------
        $this->app->singleton(FlashMessageContract::class, FlashMessage::class);
        $this->app->singleton(FlashMessage::class, fn () => new FlashMessage($this->app->make(MessageLimiterContract::class), session()));
        $this->app->singleton(MessageLimiterContract::class, MessageLimiter::class);
        $this->app->singleton(MessageLimiterContract::class, fn () => new class implements MessageLimiterContract {
            public function limit(string $message, int $limit = 20, string $end = '...'): string
            {
                return $message;
            }
        });

        //------------------- Другое -------------------
        $this->app->singleton(TagsSynchronizerServiceContract::class, TagsSynchronizerService::class);
        $this->app->singleton(BannersDataCollectorServiceContract::class, BannersDataCollectorService::class);
        $this->app->singleton(SalonsApiClientServiceContract::class, function () {
            return $this->app->make(SalonsApiClientService::class, [
                'baseUrl' => config('services.salonApi.url'),
                'user' => config('auth.basic.user'),
                'password' => config('auth.basic.password')
            ]);
        });
        $this->app->singleton(StatisticsServiceContract::class, StatisticsService::class);
        $this->app->singleton(RolesServiceContract::class, RolesService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Car::class, CarPolicy::class);
        Gate::policy(Article::class, ArticlePolicy::class);
        Gate::define('admin', function (User $user) {
            return app(RolesServiceContract::class)->userIsAdmin($user->id);
        });
        Blade::if('admin', fn () => Gate::allows('admin'));
    }
}
