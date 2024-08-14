<x-layouts.inner
    page-title="{{ $car->name }}"
    title="{{ $car->name }}"
>
    @push('styles')
        <link href="/assets/css/inner_page_template_styles.css" rel="stylesheet">
    @endpush
    @push('scripts')
        <script>
            $(function () {
                $('[data-slick-carousel-detail]').each(function () {
                    let $carousel = $(this);

                    $carousel.find('[data-slick-carousel-detail-items]').slick({
                        dots: true,
                        arrows: false,
                        appendDots: $carousel.find('[data-slick-carousel-detail-pager]'),
                        rows: 0,
                        customPaging: function (slick, index) {
                            let imageSrc = slick.$slides[index].src;

                            return `
<div class="relative">
  <svg xmlns="http://www.w3.org/2000/svg" class="active-arrow absolute -top-6 left-2/4 -ml-3 text-orange h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
  </svg>
  <span class="inline-block border rounded cursor-pointer"><img class="h-20 w-40 object-cover" src="${imageSrc}" alt="" title=""></span>
</div>`;
                        }
                    })
                })
            })
        </script>
    @endpush

    <div class="flex-1 grid grid-cols-1 lg:grid-cols-5 border-b w-full">
        <div class="col-span-3 border-r-0 sm:border-r pb-4 pr-4 text-center catalog-detail-slick-preview" data-slick-carousel-detail>
            <div class="mb-4 border rounded" data-slick-carousel-detail-items>
                <img class="w-full" src="/assets/pictures/car_K5-half.png" alt="" title="">
                <img class="w-full" src="/assets/pictures/car_k5_1.png" alt="" title="">
                <img class="w-full" src="/assets/pictures/car_k5_2.png" alt="" title="">
                <img class="w-full" src="/assets/pictures/car_k5_3.png" alt="" title="">
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
