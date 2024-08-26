@component('mail::message')
# Была создана новая новость

{{ $article->title }}

@component('mail::button', ['url' => $url])
Перейти
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
