@props(['articles'])
@forelse ($articles as $article)
    <x-articles.list_item :article="$article" />
@empty
    <p class="p-4 italic text-xl">Новости не найдены</p>
@endforelse
