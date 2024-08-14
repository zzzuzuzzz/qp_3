<tr>
    <td class="border px-4 py-2">{{ $car->id }}</td>
    <td class="border px-4 py-2">{{ $car->name }}</td>
    <td class="border px-4 py-2"><x-price :price="$car->price" /></td>
    <td class="border px-4 py-2">@isset($car->old_price)<x-price :price="$car->old_price" />@endisset</td>
    <td class="border px-4 py-2">ТЕГИ</td>
        <td class="border px-4 py-2">
            <div class="flex items-center">
                <a href="{{ route('admin.cars.edit', [$car]) }}" class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded" title="Редактировать">
                    <x-icons.edit />
                </a>
            </div>
        </td>
        <td class="border px-4 py-2">
            <form class="flex items-center" method="post" action="{{ route('admin.cars.destroy', [$car]) }}">
                @csrf
                @method('delete')
                <button  onclick="return confirm('вы уверены, что хотите удалить эту модель?')"
                    type="submit" class="inline-block bg-gray-400 hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded" title="Удалить">
                    <x-icons.delete />
                </button>
            </form>
        </td>
</tr>
