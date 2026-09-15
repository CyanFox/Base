@props([
    'item1' => null,
    'item2' => null,
])

<figure {{ $attributes->mergeClass('diff aspect-video') }} tabindex="0">
    <div class="diff-item-1" tabindex="0">
        {{ $item1 }}
    </div>
    <div class="diff-item-2">
        {{ $item2 }}
    </div>
    <div class="diff-resizer"></div>
</figure>
