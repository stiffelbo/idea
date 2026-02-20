@props([
    'status' => 'pending',
    'clickable' => false,
])

@php
    $base = 'inline-flex items-center rounded-full border px-2.5 py-1 text-xs font-medium transition select-none';
    $interactive = $clickable ? 'cursor-pointer' : '';

    $variant = match ($status) {
        'pending' => 'border-yellow-500/25 text-yellow-500 bg-yellow-500/10',
        'in_progress' => 'border-blue-500/25 text-blue-500 bg-blue-500/10',
        'completed' => 'border-emerald-500/25 text-emerald-500 bg-emerald-500/10',
        default => 'border-border text-foreground',
    };
@endphp

<button
    type="button"
    {{ $attributes->class([$base, $variant, $interactive]) }}
>
    {{ $slot }}
</button>
