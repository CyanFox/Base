@props([
    'selectedTab' => null,
])

<div role="tablist"
     {{ $attributes->mergeClass('tabs') }} x-data="{ selectedTab: '{{ $selectedTab }}' ? '{{ $selectedTab }}' : @entangle($attributes->wire('model')) }">
    {{ $slot }}
</div>
