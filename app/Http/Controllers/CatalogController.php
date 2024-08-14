<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CarsRepositoryContract;
use App\Contracts\Repositories\CategoriesRepositoryContract;
use App\Contracts\Services\CatalogDataCollectorServiceContract;
use App\DTO\CatalogFilterDTO;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function catalog(
        Request $request,
        CatalogDataCollectorServiceContract $catalogDataCollectorService,
        ?string $slug = null,
    ): View {
        $catalogFilterDTO = (new CatalogFilterDTO())
            ->setModel($request->get('model'))
            ->setMinPrice((int) $request->get('min_price'))
            ->setMaxPrice((int) $request->get('max_price'))
            ->setOrderPrice($request->get('order_price'))
            ->setOrderModel($request->get('order_model'));
        $catalogData = $catalogDataCollectorService->collectCatalogData(
            $catalogFilterDTO,
            $slug,
            10,
            $request->get('page', 1)
        );
        return view('pages.catalog', ['catalogData' => $catalogData]);
    }

    public function car(int $id, CarsRepositoryContract $carsRepository): View
    {
        $product = $carsRepository->getById($id, ['carClass', 'engine', 'body', 'tags']);
        return view('pages.product', ['car' => $product]);
    }
}
