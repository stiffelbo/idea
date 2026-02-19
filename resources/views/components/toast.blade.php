@props([
    'duration' => 3000,
])

<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, {{ $duration }})"
    x-show="show"
    x-transition.opacity.duration.600ms

    {{ $attributes->class([
        'px-4 py-3 rounded-lg fixed bottom-4 right-4',
        'bg-primary text-primary-foreground'
    ]) }}
>
    {{ $slot }}
</div>
