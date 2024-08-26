<x-layouts.inner
    page-title="Подтверждение пароля"
    title="Подтверждение пароля"
    page="confirmPassword"
    :addPage="null"
>
    <x-panels.messages.form_validation_errors />
    <x-forms.form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <x-forms.concrete-forms-fields.auth.password />
        <x-forms.row>
            <x-forms.submit-button>
                Подтвердить
            </x-forms.submit-button>
        </x-forms.row>
    </x-forms.form>
</x-layouts.inner>