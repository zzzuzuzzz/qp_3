<x-layouts.inner
    page-title="Восстановление пароля"
    title="Восстановление пароля"
    page="forgotPassword"
    :addPage="null"
>
    @if (session('status'))
        <x-panels.messages.success class="mb-4" :messages="(array) session('status')" />
    @endif
    <x-panels.messages.form_validation_errors />
    <x-forms.form method="POST" action="{{ route('password.email') }}">
        @csrf
        <x-forms.concrete-forms-fields.auth.email />
        <x-forms.row>
            <x-forms.submit-button>
                Отправить ссылку на сброс пароля
            </x-forms.submit-button>
        </x-forms.row>
    </x-forms.form>
</x-layouts.inner>