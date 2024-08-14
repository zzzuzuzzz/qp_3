<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\Admin\AdminArticlesController;
use App\Http\Controllers\Admin\AdminCarsController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PagesController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminPagesController;

Route::get('/', [PagesController::class, 'index'])->name('index');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/fin_dev', [PagesController::class, 'fin_dev'])->name('fin_dev');
Route::get('/for_clients', [PagesController::class, 'for_clients'])->name('for_clients');
Route::get('/offer', [PagesController::class, 'offer'])->name('offer');
Route::get('/catalog/{slug?}', [CatalogController::class, 'catalog'])->name('catalog');
Route::get('/product/{id}', [CatalogController::class, 'car'])->name('car');
Route::get('/articles', [ArticlesController::class, 'articles'])->name('articles');
Route::get('/articles/{article}', [ArticlesController::class, 'article'])->name('article');


Route::prefix('admin')->name('admin.')->group( function (Router $router) {
    $router->get('/', [AdminPagesController::class, 'index'])->name('index');
    $router->resource('articles', AdminArticlesController::class)->except(['show']);
    $router->resource('cars', AdminCarsController::class)->except(['show']);
});
