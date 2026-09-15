<div {{ $attributes->mergeClassFor('overflow', 'overflow-x-auto') }}>
    <table {{ $attributes->mergeClass('table table-zebra') }}>
        {{ $slot }}
    </table>
</div>
