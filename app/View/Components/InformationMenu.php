<?php

namespace App\View\Components;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
class InformationMenu extends Component
{
    public array $menu = [
        [
            'title' => 'О компании',
            'route' => 'about'
        ],
        [
            'title' => 'Контактная информация',
            'route' => 'contact'
        ],
        [
            'title' => 'Условия продаж',
            'route' => 'offer'
        ],
        [
            'title' => 'Финансовый отдел',
            'route' => 'fin_dev'
        ],
        [
            'title' => 'Для клиентов',
            'route' => 'for_clients'
        ]
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(public readonly string $template)
    {
    }
    public function render(): View|string|Closure
    {
        return view('components.information-menu.' . $this->template);
    }
}
