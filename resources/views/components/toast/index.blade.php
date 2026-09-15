<div {{ $attributes->mergeClassFor('toast', 'toast') }}>
    <div {{ $attributes->mergeClass('alert') }}>
        {{ $slot }}
    </div>
</div>
