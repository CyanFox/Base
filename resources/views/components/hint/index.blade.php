@props([
    'hint' => null
])

<fieldset {{ $attributes->twMergeFor('fieldset', 'fieldset w-fit') }}>
    {{ $slot }}
    <label {{ $attributes->twMerge('label py-0') }}>
        {{ $hint }}
    </label>
</fieldset>
