@props([
    'link' => null,
    'loading' => null,
    'hideTextWhileLoading' => false,
])

@php
    if (!function_exists('loadingTarget')) {
        function loadingTarget($attributes, $loading): ?string
        {
            if ($loading == 1) {
                return $attributes->whereStartsWith('wire:click')->first();
            }

            return $loading;
        }
    }
@endphp

@if($link)
    <a {{ $attributes->mergeClass('btn') }} href="{!! $link !!}">
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->mergeClass('btn') }}
            {{ $attributes->whereDoesntStartWith('class')->merge(['type' => 'button']) }}
            @if($loading)
                wire:target="{{ loadingTarget($attributes, $loading) }}" wire:loading.attr="disabled"
        @endif
    >
        @if($loading)
            <span wire:loading
                  wire:target="{{ loadingTarget($attributes, $loading) }}" {{ $attributes->mergeClassFor('loading', 'loading loading-spinner') }}></span>
        @endif

        @if($hideTextWhileLoading)
            <span wire:loading.remove wire:target="{{ loadingTarget($attributes, $loading) }}">
                    {{ $slot }}
                </span>
        @else
            {{ $slot }}
        @endif
    </button>
@endif
