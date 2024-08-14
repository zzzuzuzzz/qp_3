@props([
    'error' => null
])
<div class="block">
    <div class="mt-2">
        <div>
            <label class="inline-flex items-center cursor-pointer">
                {{ $slot }}
                <span class="ml-2">{{ $label }}</span>
            </label>
        </div>
        @if (! empty($error))
            <span class="text-xs italic text-red-600">{{ $error }}</span>
        @endif
    </div>
</div>
