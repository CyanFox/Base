@props([
    'icon' => null,
    'link' => null,
])

@if($link)
    <a href="{{ $link }}" {{ $attributes }}>
        @if($icon)
            <i {{ $attributes->mergeClassFor('icon', $icon) }}></i>
        @endif
        <span {{ $attributes->mergeClassFor('label', 'dock-label') }}>
            {{ $slot }}
        </span>
    </a>
@else
    <button {{ $attributes }}>
        @if($icon)
            <i {{ $attributes->mergeClassFor('icon', $icon) }}></i>
        @endif
        <span {{ $attributes->mergeClassFor('label', 'dock-label') }}>
            {{ $slot }}
        </span>
    </button>
@endif
