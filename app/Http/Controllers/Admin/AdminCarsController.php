<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\Cars\CarsRepositoryContract;
use App\Contracts\Services\Cars\CarCreationServiceContract;
use App\Contracts\Services\Cars\CarRemoverServiceContract;
use App\Contracts\Services\Cars\CarUpdateServiceContract;
use App\Contracts\Services\Flash\FlashMessageContract;
use App\Contracts\Services\TagsSynchronizerServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Http\Requests\TagsRequest;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

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
        Gate::authorize('viewAny', Car::class);
        $cars = $this->carsRepository->findAll();
        return view('pages.admin.cars.list', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        Gate::authorize('create', Car::class);
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
        Gate::authorize('create', Car::class);
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
        $car = $this->carsRepository->getById($id, ['image', 'images']);
        Gate::authorize('update', $car);
        return view('pages.admin.cars.edit', ['car' => $car]);
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
        Gate::authorize('update', $this->carsRepository->getById($id));
        $car = $carUpdateService->update($id, $request->validated(), $request->get('categories'));
        $tagsSynchronizerService->sync($car, $tagsRequest->get('tags'));
        $flashMessage->success('Модель успешно обновлена');
        return redirect()->route('admin.cars.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        int $id,
        CarRemoverServiceContract $carRemoverService,
        FlashMessageContract $flashMessage,
    ): RedirectResponse {
        Gate::authorize('delete', $this->carsRepository->getById($id));
        $carRemoverService->delete($id);
        $flashMessage->success('Модель удалена');
        return back();
    }
}
