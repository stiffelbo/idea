@props(
    ['is' => 'a']
)

<{{$is}} {{ $attributes(['class' => 'border border-border rounded-lg bg-card p-4 md:text-sm shadow-sm hover:shadow-md transition-shadow block']) }}>
    {{$slot}}
</{{$is}}>
