<x-layouts.inner
    page-title="Каталог"
    title="Каталог"
    page="catalog"
    :addPage="$catalogData->currentCategory"
>
    <x-catalog.filter class="my-4" method="get" :currentCategory="$catalogData->currentCategory" :filter-values="$catalogData->filter" />
    <x-catalog.catalog :cars="$catalogData->cars" />
    <x-panels.pagination :paginator="$catalogData->cars" />
</x-layouts.inner>
