@props([
    'title' => null,
    'hook' => null,
])
<x-card>
    @if($title)
        <x-card.title>
            @hook($hook . '.header')
                <span>{{ __($title) }}</span>
            @endhook
        </x-card.title>
    @endif

    @hook($hook . '.body')
        {{ $slot }}
    @endhook
</x-card>
