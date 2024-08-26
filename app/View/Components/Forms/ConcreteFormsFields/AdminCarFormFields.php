<?php

namespace App\View\Components\Forms\ConcreteFormsFields;

use App\Contracts\Repositories\Cars\CarBodiesRepositoryContract;
use App\Contracts\Repositories\Cars\CarClassesRepositoryContract;
use App\Contracts\Repositories\Cars\CarEnginesRepositoryContract;
use App\Contracts\Repositories\CategoriesRepositoryContract;
use App\Models\Car;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminCarFormFields extends Component
{
    public function __construct(
        public readonly Car $car,
        private readonly CarBodiesRepositoryContract $carBodiesRepository,
        private readonly CarClassesRepositoryContract $carClassesRepository,
        private readonly CarEnginesRepositoryContract $carEnginesRepository,
        private readonly CategoriesRepositoryContract $categoriesRepository
    ) {
    }

    public function render(): View|string|Closure
    {
        $carBodies = $this->carBodiesRepository->findAll();
        $carClasses = $this->carClassesRepository->findAll();
        $carEngines = $this->carEnginesRepository->findAll();
        $categories = $this->categoriesRepository->findAll();
        return
            view('components.forms.concrete-forms-fields.admin-car-form-fields', [
                'carBodies' => $carBodies,
                'carClasses' => $carClasses,
                'carEngines' => $carEngines,
                'categories' => $categories,
                ]);
    }
}
