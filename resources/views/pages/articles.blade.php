<x-layouts.inner_two_columns
    page-title="Все новости"
    title="Все новости"
>
    <div class="space-y-4">
        <x-articles.list :articles="$articlesData->articles"/>
    </div>
    <x-panels.pagination :paginator="$articlesData->articles" />
</x-layouts.inner_two_columns>
