<x-layouts.inner
    page-title="Подтверждение регистрации"
    title="Подтверждение регистрации"
    page="verifyEmail"
    :addPage="null"
>
    @if (session('status') == 'verification-link-sent')
        <x-panels.messages.success class="mb-4" :messages="['Ссылка на завершение регистрации была отправлена на ваш email']" />
    @endif
    <x-forms.form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <x-forms.row>
            <x-forms.submit-button>
                Отправить ссылку заново
            </x-forms.submit-button>
        </x-forms.row>
    </x-forms.form>
    <x-forms.form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-forms.row>
            <x-forms.cancel-button>
                Выйти
            </x-forms.cancel-button>
        </x-forms.row>
    </x-forms.form>
</x-layouts.inner>