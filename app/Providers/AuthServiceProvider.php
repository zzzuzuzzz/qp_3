<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Car;
use App\Policies\ArticlePolicy;
use App\Policies\CarPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Car::class => CarPolicy::class,
        Article::class => ArticlePolicy::class
    ];

    public function boot()
    {
    }
}