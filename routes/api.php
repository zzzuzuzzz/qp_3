<?php

use App\Http\Controllers\Api\CarsController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\BasicAuthMiddleware;

Route::apiResource('cars', CarsController::class)->middleware(BasicAuthMiddleware::class);
