@props([
    'tooltip' => null,
])

<div {{ $attributes->twMerge('tooltip') }}>
    <div {{ $attributes->twMergeFor('content', 'tooltip-content') }}>
        {!! $tooltip !!}
    </div>
    {{ $slot }}
</div>
