<x-layouts.admin
    page-title="Форма создания новостей"
    title="Форма создания новостей"
>
    <x-forms.form action="{{ route('admin.articles.store') }}" method="post">
        <x-forms.concrete-forms-fields.admin-article-form-fields :article="$article" />
        <x-forms.row>
            <x-forms.submit-button>
                Сохранить
            </x-forms.submit-button>
            <x-forms.cancel-button href="{{ route('admin.articles.index') }}" >
                Отменить
            </x-forms.cancel-button>
        </x-forms.row>
    </x-forms.form>
</x-layouts.admin>
