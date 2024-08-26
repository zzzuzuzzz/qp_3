<x-layouts.app page-title="{{ $pageTitle ?? null }}">
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render($page, $title) }}
    </x-slot:breadcrumbs>
    <div class="flex-1 grid grid-cols-4 lg:grid-cols-5 border-b">
        <aside class="hidden sm:block col-span-1 border-r p-4">
            <x-information-menu template="left" />
        </aside>
        <div class="col-span-4 sm:col-span-3 lg:col-span-4 p-4">
            <h1 class="text-black text-3xl font-bold mb-4"> {{ $title }} </h1>
            {{ $slot }}
        </div>
    </div>
</x-layouts.app>
