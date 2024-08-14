<x-layouts.app
    page-title="{{ $pageTitle ?? '' }}"
>
    <x-slot:navigationMenu>
        <x-panels.admin.navigation_menu />
    </x-slot:navigationMenu>
    <div class="p-4">
        <h1 class="text-black text-3xl font-bold mb-4">{{ $title }}</h1>
        <x-panels.messages.flashes />
        {{ $slot }}
    </div>
    <x-slot:footerNavigation></x-slot:footerNavigation>
</x-layouts.app>
