@props(['article'])
@csrf
<x-forms.groups.group for="fieldArticleName" error="{{ $errors->first('title') }}">
    <x-slot:label>Название новости</x-slot:label>
    <x-forms.inputs.text
        id="fieldArticleName"
        name="title"
        placeholder="Парадигма просветляет архетип"
        value="{{ old('title', $article->title) }}"
        error="{{ $errors->first('title') }}"
    />
</x-forms.groups.group>

<x-forms.groups.checkbox-group error="{{ $errors->first('published_at') }}">
    <x-slot:label>Опубликовать</x-slot:label>
    <x-forms.inputs.checkbox
        name="published_at"
        :checked="old('published_at', $article->published_at)"
    />
</x-forms.groups.checkbox-group>

<x-forms.groups.group for="fieldCarMainImage" error="{{ $errors->first('image') }}">
    <x-slot:label>Изображение новости</x-slot:label>
    <div class="flex items-center justify-center border rounded mb-2"><img src="/assets/images/no_image.png" class="max-w-full max-h-60"></div>
    <x-forms.inputs.one-file
        id="fieldArticleImage"
    />
</x-forms.groups.group>

<x-forms.groups.group for="fieldArticleDescription" error="{{ $errors->first('description') }}">
    <x-slot:label>Краткое описание</x-slot:label>
    <x-forms.inputs.textarea
        id="fieldArticleDescription"
        name="description"
        value="{{ old('description', $article->description) }}"
        error="{{ $errors->first('description') }}"
    />
</x-forms.groups.group>

<x-forms.groups.group for="fieldArticleBody" error="{{ $errors->first('body') }}">
    <x-slot:label>Текст новости</x-slot:label>
    <x-forms.inputs.textarea
        id="fieldArticleBody"
        name="body"
        value="{{ old('body', $article->body) }}"
        error="{{ $errors->first('body') }}"
    />
</x-forms.groups.group>

<x-forms.groups.group for="fieldCarTags" error="{{ $errors->first('tags') }}">
    <x-slot:label>Теги</x-slot:label>
    <x-forms.inputs.text
        id="fieldArticleTags"
        name="tags"
        placeholder="Парадигма, Архетип, Киа Seed"
        value="{{ old('tags', $article->tags->pluck('name')->implode(',')) }}"
        error="{{ $errors->first('tags') }}"
    />
</x-forms.groups.group>
