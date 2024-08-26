@component('mail::message')
# Была удалена новость

{{ $article->title }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
