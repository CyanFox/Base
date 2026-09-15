@props([
    'label' => null,
    'hint' => null,
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

    <textarea {{ $attributes->mergeClass('textarea ' . ($hasValidationErrors ? 'textarea-error' : '')) }}></textarea>

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
