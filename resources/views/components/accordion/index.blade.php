@props([
    'uuid' => str()->uuid()
])

<details {{ $attributes->mergeClass('collapse bg-base-100 border border-base-300') }} name="{{ $uuid }}">
    {{ $slot }}
</details>
