<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\Cars\CarsRepositoryContract;
use App\Contracts\Services\Cars\CarCreationServiceContract;
use App\Contracts\Services\Cars\CarRemoverServiceContract;
use App\Contracts\Services\Cars\CarUpdateServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CarRequest;
use App\Http\Resources\CarResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CarsController extends Controller
{
    public function index(CarsRepositoryContract $carsRepository): AnonymousResourceCollection
    {
        return CarResource::collection($carsRepository->findAll());
    }
    public function store(CarRequest $request, CarCreationServiceContract $carCreationService): CarResource
    {
        return new CarResource($carCreationService->create(
            $request->validated(),
            $request->get('categories', [])
        ));
    }
    public function show($id, CarsRepositoryContract $carsRepository): CarResource
    {
        return new CarResource($carsRepository->getById($id, ['image:id,path', 'categories']));
    }
    public function update(CarRequest $request, $id, CarUpdateServiceContract $carUpdateService): CarResource
    {
        return new CarResource($carUpdateService->update(
            $id, $request->validated(),
            $request->get('categories')
        ));
    }
    public function destroy($id, CarRemoverServiceContract $carRemoverService)
    {
        $carRemoverService->delete($id);
        return [$id];
    }
}
