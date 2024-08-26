@props(['articles'])
<x-layouts.app page-title="Главная страница">

    <x-slot:headerLogo>
        <span class="inline-block sm:inline">
            <img src="/assets/images/logo.png" width="222" height="30" alt="">
        </span>
    </x-slot:headerLogo>

    <section class="slider">
        <div data-slick-carousel>
            @foreach($banners as $banner)
                <x-banners.banner_item :banner="$banner"/>
            @endforeach
        </div>
    </section>
    <section class="pb-4 px-4">
        @if($cars && $cars->count())
            <p class="inline-block text-3xl text-black font-bold mb-4">Модели недели</p>
            <x-catalog.catalog :cars="$cars" />
        @endif
    </section>
    <section class="news-block-inverse px-4 py-4">
        <div>
            <p class="inline-block text-3xl text-white font-bold mb-4">Новости</p>
            <span class="inline-block text-gray-200 pl-1"> / <a href="{{ route('articles') }}" class="inline-block pl-1 text-gray-200 hover:text-orange"><b>Все</b></a></span>
        </div>
        <div class="grid md:grid-cols-1 lg:grid-cols-3 gap-6">
            @foreach($articles as $article)
                <x-articles.homepage_item :article="$article"/>
            @endforeach
        </div>
    </section>
</x-layouts.app>
