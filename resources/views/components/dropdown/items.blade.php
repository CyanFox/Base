@props([
    'position' => 'auto',
])

<div x-data="{
         placement: @js($position),
         updatePlacement(menu) {
             const trigger = menu.parentElement.firstElementChild.getBoundingClientRect();
             const spaces = {
                 bottom: window.innerHeight - trigger.bottom,
                 top: trigger.top,
                 right: window.innerWidth - trigger.right,
                 left: trigger.left,
             };

             const direction = @js($position) === 'auto'
                 ? Object.keys(spaces).reduce((largest, current) =>
                     spaces[current] > spaces[largest] ? current : largest
                 )
                 : @js($position);

             this.placement = direction === 'bottom' || direction === 'top'
                 ? `${direction}-${trigger.left + trigger.width / 2 > window.innerWidth / 2 ? 'right' : 'left'}`
                 : direction;
         }
     }"
     x-init="$watch('isOpen', open => open && $nextTick(() => updatePlacement($el))); $watch('openedWithKeyboard', open => open && $nextTick(() => updatePlacement($el)))"
     x-cloak
     x-show="isOpen || openedWithKeyboard"
     x-transition
     x-trap="openedWithKeyboard"
     x-on:click.outside="isOpen = false, openedWithKeyboard = false"
     x-on:resize.window="(isOpen || openedWithKeyboard) && updatePlacement($el)"
     x-on:scroll.window="(isOpen || openedWithKeyboard) && updatePlacement($el)"
     x-on:keydown.down.prevent="$focus.wrap().next()"
     x-on:keydown.up.prevent="$focus.wrap().previous()"
     :class="{
         'top-full left-0 mt-1': placement === 'bottom-left',
         'top-full right-0 mt-1': placement === 'bottom-right',
         'bottom-full left-0 mb-1': placement === 'top-left',
         'bottom-full right-0 mb-1': placement === 'top-right',
         'left-full top-0 ml-1': placement === 'right',
         'right-full top-0 mr-1': placement === 'left'
     }"
     {{ $attributes->twMerge('absolute z-50 box-border max-w-[calc(100vw-1rem)] max-h-[calc(100vh-1rem)] min-w-full w-max flex flex-col overflow-auto rounded-radius border border-outline bg-surface-alt dark:border-outline-dark dark:bg-surface-dark-alt') }}
     role="menu">
    {{ $slot }}
</div>
