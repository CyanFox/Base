@props([
    'label' => null,
    'hint' => null,
    'tooltip' => null,
    'showRequired' => true,
    'showValidation' => true,
    'placeholder' => null,
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

    <select {{ $attributes->mergeClass('select ' . ($hasValidationErrors ? 'select-error' : '')) }}>
        @if($placeholder)
            <option disabled selected value="">{{ $placeholder }}</option>
        @endif
        {{ $slot }}
    </select>

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
