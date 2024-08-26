<div class="w-full flex">
    <div class="h-48 lg:h-auto w-32 sm:w-60 lg:w-32 xl:w-48 flex-none text-center overflow-hidden">
        <img class="w-full" src="{{ $article->imageUrl }}" alt="{{ $article->name }}">
    </div>
    <div class="px-4 leading-normal">
        <div class="mb-8 space-y-2">
            <div class="text-black font-bold text-xl">
                <a class="hover:text-orange" href="{{ route('article', $article) }}">{{ $article->title }}</a>
            </div>
            <p class="text-gray-600 text-base">
                <a class="hover:text-orange" href="{{ route('article', $article) }}">{{ $article->description }}</a>
            </p>
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
</div>
