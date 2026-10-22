@props([
    'target' => '',
    'backUrl' => null,
    'showSubmit' => true,
    'showCancel' => false,
    'submitText' => __('messages.buttons.confirm'),
    'cancelText' => __('messages.buttons.cancel'),
])

<x-divider/>

<div {{ $attributes->merge(['class' => 'flex sm:flex-row flex-col sm:w-fit w-full gap-2']) }}>
    @if ($showSubmit)
        <x-button loading="{{ $target }}"
                  type="submit">{{ $submitText }}</x-button>
    @endif

    {{ $slot }}

    @if ($showCancel)
        <x-button type="button" href="{{ $backUrl ?? url()->previous() }}" variant="outline"
                  wire:navigate>{{ $cancelText }}</x-button>
    @endif
</div>
