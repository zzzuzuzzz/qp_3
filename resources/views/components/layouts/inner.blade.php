<x-layouts.app page-title="{{ $pageTitle ?? null }}">

    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render($page, $title, $addPage) }}
    </x-slot:breadcrumbs>

    <div class="p-4">
        <h1 class="text-black text-3xl font-bold mb-4">{{ $title }}</h1>
        {{ $slot }}
    </div>

</x-layouts.app>


