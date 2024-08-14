<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Repositories\CarsRepositoryContract;
use App\Models\Article;
use App\Models\Car;
use Database\Seeders\ArticleSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function index(CarsRepositoryContract $carsRepository, ArticlesRepositoryContract $articlesRepository)
    {
        $cars = $carsRepository->findForMainPage(4);
        $articles = $articlesRepository->findForMainPage(3);
        return view('pages.homepage', ['articles' => $articles, 'cars' => $cars]);
    }
    public function about()
    {
        return view('pages.about');
    }
    public function contact()
    {
        return view('pages.contact');
    }
    public function offer()
    {
        return view('pages.offer');
    }
    public function fin_dev()
    {
        return view('pages.fin_dev');
    }
    public function for_clients()
    {
        /**
         * @var \Illuminate\Support\Collection $cars
         */
        $cars = \App\Models\Car::get();
        $cars->load(['carClass', 'engine', 'body']);
        $price = $cars->avg('price');
        $avgPrice = $cars->whereNotNull('old_price')->avg('price');
        $maxPrice = $cars->sortByDesc('price')->take(1);
        $salons = $cars->pluck('salon')->unique();
        $engines = $cars->pluck('engine.name')->sort()->values()->unique();
        $classes = $cars->pluck('carClass.name')->sort()->mapWithKeys( function ($item, $key) {
            return [Str::slug($item) => $item];
        });
        $filter = $cars->whereNotNull('old_price')
            ->filter(function ($item) {
                return false !== stristr($item->kpp, '6') || stristr($item->kpp, '5') || stristr($item->name, '6') || stristr($item->name, '5') || stristr($item->engine->name, '6') || stristr($item->engine->name, '5');
            });
        $bodies = $cars->whereNotNull('body_id')->whereNull('old_price')->groupBy('body.name')->map(function ($item) {
            return $item->avg('price');
        })->sort();
        return view('pages.for_clients', [
            'cars' => $cars,
            'price' => $price,
            'avgPrice' => $avgPrice,
            'maxPrice' => $maxPrice,
            'salons' => $salons,
            'engines' => $engines,
            'classes' => $classes,
            'filter' => $filter,
            'bodies' => $bodies
        ]);
    }
}
