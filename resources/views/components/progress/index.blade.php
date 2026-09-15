@props([
    'value' => 0,
    'max' => 100
])

<progress {{ $attributes->mergeClass('progress') }} @if($value && $max) value="{{ $value }}"
          max="{{ $max }}" @endif>{{ $slot }}</progress>
