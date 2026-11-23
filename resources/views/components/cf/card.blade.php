@props([
    'title' => null,
    'hook' => null,
])
<x-card>
    @if($title)
        <x-card.title>
            {!! $title !!}

            @if($hook)
                @shook('s.' . $hook . '.title')
            @endif
        </x-card.title>
    @endif

    @if($hook)
        @hook($hook . '.card')
    @endif

    {{ $slot }}

    @if($hook)
        @endhook
    @endif
</x-card>
