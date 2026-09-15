@props([
    'uuid' => str()->uuid(),
    'link' => null,
])

@if($link)
    <a @click="selectedTab = '{{ $uuid }}'" :aria-selected="selectedTab === '{{ $uuid }}'"
       :tabindex="selectedTab === '{{ $uuid }}' ? '0' : '-1'"
       :class="selectedTab === '{{ $uuid }}' ? 'tab-active' : ''"
       :selected="selectedTab === '{{ $uuid }}'"
       href="{{ $link }}"
       {{ $attributes->mergeClass('tab') }} role="tab"
       aria-controls="tabpanel{{ ucfirst($uuid) }}">
        {{ $slot }}
    </a>
@else
    <button @click="selectedTab = '{{ $uuid }}'" :aria-selected="selectedTab === '{{ $uuid }}'"
            :tabindex="selectedTab === '{{ $uuid }}' ? '0' : '-1'"
            :class="selectedTab === '{{ $uuid }}' ? 'tab-active' : ''"
            :selected="selectedTab === '{{ $uuid }}'"
            {{ $attributes->twMerge('tab') }} type="button" role="tab"
            aria-controls="tabpanel{{ ucfirst($uuid) }}">
        {{ $slot }}
    </button>
@endif
