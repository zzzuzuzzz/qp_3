<x-layouts.inner
    page-title="{{ $car->name }}"
    title="{{ $car->name }}"
    page="product"
    :addPage="null"
>

    <div class="flex-1 grid grid-cols-1 lg:grid-cols-5 border-b w-full">
        <div class="col-span-3 border-r-0 sm:border-r pb-4 pr-4 text-center catalog-detail-slick-preview" data-slick-carousel-detail>
            <div class="mb-4 border rounded" data-slick-carousel-detail-items>
                <img class="w-full" src="{{ $car->imageUrl }}" alt="{{ $car->name }}">
                @foreach ($car->images as $image)
                    <img class="w-full" src="{{ $image->url }}" alt="{{ $car->name }}">
                @endforeach
            </div>
            <div class="flex space-x-4 justify-center items-center" data-slick-carousel-detail-pager>
            </div>
        </div>
        <div class="col-span-1 lg:col-span-2">
            <div class="space-y-4 w-full">
                <div class="block px-4">
                    <p class="font-bold">Цена:</p>
                    @isset($car->old_price)
                        <p class="text-base line-through text-gray-400"><x-price :price="$car->price" /></p>
                    @endisset
                    <p class="font-bold text-2xl text-orange"><x-price :price="$car->price" /></p>
                    <div class="mt-4 block">
                        <form>
                            <x-forms.submit-button>
                                <x-icons.basket class="inline-block h-6 w-6 mr-2" />
                                Купить
                            </x-forms.submit-button>
                        </form>
                    </div>
                </div>
                <x-panels.accordion :active="true">
                    <x-slot:label>Параметры</x-slot:label>
                    <x-catalog.detail-product-props>
                        <x-catalog.detail-product-props-row :title="'Салон'">
                            {{ $car->salon }}
                        </x-catalog.detail-product-props-row>
                        <x-catalog.detail-product-props-row :title="'Класс'">
                            {{ $car->carClass->name }}
                        </x-catalog.detail-product-props-row>
                        <x-catalog.detail-product-props-row :title="'КПП'">
                            {{ $car->kpp }}
                        </x-catalog.detail-product-props-row>
                        <x-catalog.detail-product-props-row :title="'Год выпуска'">
                            {{ $car->year }}
                        </x-catalog.detail-product-props-row>
                        <x-catalog.detail-product-props-row :title="'Цвет'">
                            {{ $car->color }}
                        </x-catalog.detail-product-props-row>
                        <x-catalog.detail-product-props-row :title="'Кузов'">
                            {{ $car->body->name }}
                        </x-catalog.detail-product-props-row>
                        <x-catalog.detail-product-props-row :title="'Двигатель'">
                            {{ $car->engine->name }}
                        </x-catalog.detail-product-props-row>
                        @if ($car->tags->isNotEmpty())
                            <x-catalog.detail-product-props-row :title="'Теги'">
                                <x-slot:title>Теги</x-slot:title>
                                <x-panels.tags :tags="$car->tags"/>
                            </x-catalog.detail-product-props-row>
                        @endif
                    </x-catalog.detail-product-props>
                </x-panels.accordion>
                <x-panels.accordion>
                    <x-slot:label>Описание</x-slot:label>
                    <div class="space-y-4">
                        {!! $car->description !!}
                    </div>
                </x-panels.accordion>
            </div>
        </div>
    </div>
</x-layouts.inner>
