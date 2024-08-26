@component('mail::message')
# Была обновлена новость

{{ $article->title }}

@component('mail::button', ['url' => $url])
Перейти
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
