@props(['article'])
<div class="w-full flex">
    <div class="h-48 lg:h-auto w-32 sm:w-60 lg:w-32 xl:w-48 flex-none text-center overflow-hidden">
        <a class="block w-full h-40" href="{{ route('article', $article) }}">
            <img class="w-full h-full hover:opacity-90 object-cover" src="{{ $article->imageUrl }}" alt="{{ $article->title }}">
        </a>
    </div>
    <div class="px-4 flex flex-col justify-between leading-normal">
        <div class="mb-8">
            <div class="text-white font-bold text-xl mb-2">
                <a class="hover:text-orange" href="{{ route('article', $article) }}">{{ $article->title }}</a>
            </div>
            <p class="text-gray-300 text-base">
                <a class="hover:text-orange" href="{{ route('article', $article) }}">{{ $article->description }}</a>
            </p>
        </div>
        @if ($article->tags->isNotEmpty())
            <x-catalog.detail-product-props-row :title="'Теги'">
                <x-slot:title>Теги</x-slot:title>
                <x-panels.tags :tags="$article->tags"/>
            </x-catalog.detail-product-props-row>
        @endif
        <div class="flex items-center">
            <p class="text-sm text-gray-400 italic">{{ $article->published_at }}</p>
        </div>
    </div>
</div>
