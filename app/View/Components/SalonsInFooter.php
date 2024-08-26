<?php

namespace App\View\Components;

use App\Contracts\Repositories\SalonsRepositoryContract;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SalonsInFooter extends Component
{
    public function __construct(private readonly SalonsRepositoryContract $salonsRepository)
    {
    }

    public function render(): View|string|Closure
    {
        $salons = $this->salonsRepository->footer();
        return view('components.panels.salons-in-footer', ['salons' => $salons]);
    }
}