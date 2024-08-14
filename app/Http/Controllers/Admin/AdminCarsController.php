<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\CarsRepositoryContract;
use App\Contracts\Services\CarUpdateServiceContract;
use App\Contracts\Services\FlashMessageContract;
use App\Contracts\Services\TagsSynchronizerServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Http\Requests\TagsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Contracts\Services\CarCreationServiceContract;

class AdminCarsController extends Controller
{
    public function __construct(private readonly CarsRepositoryContract $carsRepository)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $cars = $this->carsRepository->findAll();
        return view('pages.admin.cars.list', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.admin.cars.create', ['car' => $this->carsRepository->getModel()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        CarRequest $request,
        TagsRequest $tagsRequest,
        FlashMessageContract $flashMessage,
        CarCreationServiceContract $carCreationService,
        TagsSynchronizerServiceContract $tagsSynchronizerService,
    ): RedirectResponse {
        $car = $carCreationService->create($request->validated(), $request->get('categories'));
        $tagsSynchronizerService->sync($car, $tagsRequest->get('tags'));
        $flashMessage->success('Модель успешно создана');
        return redirect()->route('admin.cars.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        return view('pages.admin.cars.edit', ['car' => $this->carsRepository->getById($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CarRequest $request,
        TagsRequest $tagsRequest,
        int $id,
        FlashMessageContract $flashMessage,
        CarUpdateServiceContract $carUpdateService,
        TagsSynchronizerServiceContract $tagsSynchronizerService,
    ): RedirectResponse {
        $carUpdateService->update($id, $request->validated(), $request->get('categories'));
        $tagsSynchronizerService->sync($car, $tagsRequest->get('tags'));
        $flashMessage->success('Модель успешно обновлена');
        return redirect()->route('admin.cars.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, FlashMessageContract $flashMessage): RedirectResponse
    {
        $this->carsRepository->delete($id);
        $flashMessage->success('Модель успешно удалена');
        return redirect()->route('admin.cars.index');
    }
}
