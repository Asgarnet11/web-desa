@props([
    'color' => 'blue'
])

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 px-3.5 py-1 rounded-full text-xs font-bold tracking-wide uppercase bg-[#219EBC]/15 text-[#17708A]']) }}>
    {{ $slot }}
</span>

