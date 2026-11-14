@props([
    'hover' => true
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-[24px] p-6 border border-[#52B788]/20 shadow-soft ' . ($hover ? 'shadow-hover' : '')]) }}>
    {{ $slot }}
</div>

