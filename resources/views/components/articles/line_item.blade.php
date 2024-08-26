<tr>
    <td class="border px-4 py-2">{{ $article->id }}</td>
    <td class="border px-4 py-2">{{ $article->title }}</td>
    <td class="border px-4 py-2">{{ $article->description }}</td>
    <td class="border px-4 py-2">{{ $article->published_at }}</td>
    <td class="border px-4 py-2">ТЕГИ</td>
    <td class="border px-4 py-2">
        <div class="flex items-center">
            <a href="{{ route('admin.articles.edit', [$article]) }}" class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded" title="Редактировать">
                <x-icons.edit />
            </a>
        </div>
    </td>
    <td class="border px-4 py-2">
        <form class="flex items-center" method="post" action="{{ route('admin.articles.destroy', [$article]) }}">
            @csrf
            @method('delete')
            <button  onclick="return confirm('вы уверены, что хотите удалить эту новость?')"
                     type="submit" class="inline-block bg-gray-400 hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded" title="Удалить">
                <x-icons.delete />
            </button>
        </form>
    </td>
</tr>
