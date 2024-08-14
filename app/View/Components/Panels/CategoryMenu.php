<?php

namespace App\View\Components\Panels;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;
use App\Contracts\Repositories\CategoriesRepositoryContract;

class CategoryMenu extends Component
{
    private ?Category $currentCategory;
    public function __construct(private readonly CategoriesRepositoryContract $categoriesRepository)
    {
        $categorySlug = Route::current()->slug;
        $this->currentCategory = $categorySlug ? $this->categoriesRepository->findBySlug($categorySlug, ['ancestors']) : null;
    }

    public function render(): View|string|Closure
    {
        $categories = $this->categoriesRepository->getTree(1);
        return view('components.panels.category-menu', ['categories' => $categories]);
    }

    public function selectedCategory(?Category $category = null): bool
    {
        if (!Route::is('catalog')) {
            return false;
        }
        if ($category === null || $this->currentCategory === null) {
            return $this->currentCategory === $category;
        }
        return $this->currentCategory->id === $category->id || $this->currentCategory->ancestors->keyBy('id')->has($category->id);
    }
}
