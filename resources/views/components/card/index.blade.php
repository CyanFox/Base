<div {{ $attributes->mergeClass('card card-border bg-base-100') }}>
    <div {{ $attributes->mergeClassFor('body', 'card-body') }}>
        {{ $slot }}
    </div>
</div>
