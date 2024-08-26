<?php

namespace App\Providers;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Repositories\BannersRepositoryContract;
use App\Contracts\Repositories\Cars\CarBodiesRepositoryContract;
use App\Contracts\Repositories\Cars\CarClassesRepositoryContract;
use App\Contracts\Repositories\Cars\CarEnginesRepositoryContract;
use App\Contracts\Repositories\Cars\CarsRepositoryContract;
use App\Contracts\Repositories\CategoriesRepositoryContract;
use App\Contracts\Repositories\ImagesRepositoryContract;
use App\Contracts\Repositories\RolesRepositoryContract;
use App\Contracts\Repositories\SalonsRepositoryContract;
use App\Contracts\Repositories\StatisticsRepositoryContract;
use App\Contracts\Repositories\TagsRepositoryContract;
use App\Repositories\ArticlesRepository;
use App\Repositories\BannersRepository;
use App\Repositories\Cars\CarBodiesRepository;
use App\Repositories\Cars\CarClassesRepository;
use App\Repositories\Cars\CarEnginesRepository;
use App\Repositories\Cars\CarsRepository;
use App\Repositories\CategoriesRepository;
use App\Repositories\ImagesRepository;
use App\Repositories\RolesRepository;
use App\Repositories\SalonsRepository;
use App\Repositories\StatisticsRepository;
use App\Repositories\TagsRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //------------------- Машины -------------------
        $this->app->singleton(CarBodiesRepositoryContract::class, CarBodiesRepository::class);
        $this->app->singleton(CarClassesRepositoryContract::class, CarClassesRepository::class);
        $this->app->singleton(CarEnginesRepositoryContract::class, CarEnginesRepository::class);
        $this->app->singleton(CarsRepositoryContract::class, CarsRepository::class);

        //------------------- Новости -------------------
        $this->app->singleton(ArticlesRepositoryContract::class, ArticlesRepository::class);

        //------------------- Другое -------------------
        $this->app->singleton(SalonsRepositoryContract::class, SalonsRepository::class);
        $this->app->singleton(CategoriesRepositoryContract::class, CategoriesRepository::class);
        $this->app->singleton(ImagesRepositoryContract::class, ImagesRepository::class);
        $this->app->singleton(TagsRepositoryContract::class, TagsRepository::class);
        $this->app->singleton(BannersRepositoryContract::class, BannersRepository::class);
        $this->app->singleton(StatisticsRepositoryContract::class, StatisticsRepository::class);
        $this->app->singleton(RolesRepositoryContract::class, RolesRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
