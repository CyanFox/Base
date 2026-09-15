@props([
    'uuid' => str()->uuid(),
    'amount' => 5,
    'label' => null,
    'hint' => null,
    'value' => 0,
    'min' => 0,
    'max' => 100,
    'tooltip' => null,
    'showRequired' => true,
    'showValidation' => true,
])

@php($hasValidationErrors = $attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)

<fieldset {{ $attributes->mergeClassFor('fieldset', 'fieldset w-fit ' . ($tooltip ? 'tooltip' : '')) }}>
    @if($tooltip)
        <div {{ $attributes->mergeClassFor('tooltip', 'tooltip-content') }}>
            {!! $tooltip !!}
        </div>
    @endif

    @if($label)
        <legend {{ $attributes->mergeClassFor('label', 'fieldset-legend') }}>
            {{ $label }}

            @if($attributes->get('required') && $showRequired)
                <span class="text-error">*</span>
            @endif
        </legend>
    @endif

    <div {{ $attributes->mergeClassFor('rating', 'rating') }}>
        @for($i = 0; $i < $amount; $i++)
            <input type="radio" name="{{ $uuid }}" value="{{ $i + 1}}"
                   {{ $attributes->mergeClass('mask mask-star ' . ($hasValidationErrors ? 'bg-error' : '')) }} aria-label="{{ $i }} star"/>
        @endfor
    </div>

    @if($hasValidationErrors)
        <div
            class="text-error text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif

    @if($hint)
        <p {{ $attributes->mergeClassFor('hint', 'label') }}>
            {{ $hint }}
        </p>
    @endif
</fieldset>
