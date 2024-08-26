@props(['car'])
<div class="bg-white w-full border border-gray-100 rounded overflow-hidden shadow-lg hover:shadow-2xl pt-4">
    <a class="block w-full h-40" href="{{ route('car', $car) }}">
        <img class="w-full h-full hover:opacity-90 object-cover" src="{{ $car->imageUrl }}" alt="{{ $car->name }}">
    </a>
    <div class="px-6 py-4">
        <div class="text-black font-bold text-xl mb-2"><a class="hover:text-orange" href="{{ route('car', $car) }}">{{ $car->name }}</a></div>
        <p class="text-grey-darker text-base">
            <span class="inline-block"><x-price :price="$car->price" /></span>
            @isset ($car->old_price)
                <span class="inline-block line-through pl-6 text-gray-400"><x-price :price="$car->old_price" /></span>
            @endisset
        </p>
    </div>
</div>
