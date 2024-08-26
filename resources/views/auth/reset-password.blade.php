<x-layouts.inner
    page-title="Сброс пароля"
    title="Сброс пароля"
    page="resetPassword"
    :addPage="null"
>
    <x-panels.messages.form_validation_errors />
    <x-forms.form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('put')
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <x-forms.concrete-forms-fields.auth.email />
        <x-forms.concrete-forms-fields.auth.password :withConfirmation="true" />
        <x-forms.row>
            <x-forms.submit-button>
                Сбросить пароль
            </x-forms.submit-button>
        </x-forms.row>
    </x-forms.form>
</x-layouts.inner>