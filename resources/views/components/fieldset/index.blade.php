@props([
    'label' => null,
    'hint' => null,
    'tooltip' => null,
    'showRequired' => true,
])

<fieldset {{ $attributes->mergeClass('fieldset w-fit ' . ($tooltip ? 'tooltip' : '')) }}>
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

    {{ $slot }}

    @if($hint)
        <p {{ $attributes->mergeClassFor('hint', 'label') }}>
            {{ $hint }}
        </p>
    @endif
</fieldset>
