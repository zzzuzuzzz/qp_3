<x-layouts.inner_two_columns
    page-title="{{ $article->title }}"
    title="{{ $article->title }}"
    page="article"
>
    <div class="space-y-4">
        <img class="w-full" src="{{ $article->imageUrl }}" alt="{{ $article->name }}">

        @if ($article->tags->isNotEmpty())
            <x-catalog.detail-product-props-row :title="'Теги'">
                <x-slot:title>Теги</x-slot:title>
                <x-panels.tags :tags="$article->tags"/>
            </x-catalog.detail-product-props-row>
        @endif

        <p>{!! $article->body !!}</p>
    </div>

    <div class="mt-4">
        <a class="inline-flex items-center text-orange hover:opacity-75" href="{{ route('articles') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
            </svg>
            К списку новостей
        </a>
    </div>
</x-layouts.inner_two_columns>
