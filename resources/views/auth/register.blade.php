<x-layouts.inner
    page-title="Регистрация"
    title="Регистрация"
    page="register"
    :addPage="null"
>
    <x-panels.messages.form_validation_errors />
    <x-forms.form method="POST" action="{{ route('register') }}">
        @csrf
        <x-forms.groups.group for="email" error="{{ $errors->first('name') }}">
            <x-slot:label>Ваше имя</x-slot:label>
            <x-forms.inputs.text
                id="name"
                name="name"
                placeholder="Николай Николаич"
                required autofocus
                value="{{ old('name') }}"
                error="{{ $errors->first('name') }}"
            />
        </x-forms.groups.group>
        <x-forms.concrete-forms-fields.auth.email />
        <x-forms.concrete-forms-fields.auth.password :withConfirmation="true" />
        <x-forms.row class="space-x-4">
            <x-forms.submit-button>
                Регистрация
            </x-forms.submit-button>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}"> Уже зарегистрированы? </a>
            @endif
        </x-forms.row>
    </x-forms.form>
</x-layouts.inner>