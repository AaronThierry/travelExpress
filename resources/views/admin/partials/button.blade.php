@props([
    'variant' => 'primary', // primary, secondary, success, danger, warning, ghost
    'size' => 'md', // sm, md, lg
    'type' => 'button',
    'icon' => null,
    'loading' => false,
    'disabled' => false
])

@php
    $variants = [
        'primary' => 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white hover:from-indigo-700 hover:to-purple-700 shadow-md shadow-indigo-500/30',
        'secondary' => 'bg-slate-200 text-slate-700 hover:bg-slate-300',
        'success' => 'bg-gradient-to-r from-green-600 to-emerald-600 text-white hover:from-green-700 hover:to-emerald-700 shadow-md shadow-green-500/30',
        'danger' => 'bg-gradient-to-r from-red-600 to-pink-600 text-white hover:from-red-700 hover:to-pink-700 shadow-md shadow-red-500/30',
        'warning' => 'bg-gradient-to-r from-yellow-500 to-orange-500 text-white hover:from-yellow-600 hover:to-orange-600 shadow-md shadow-yellow-500/30',
        'ghost' => 'text-slate-600 hover:bg-slate-100 border border-slate-200'
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2.5 text-base',
        'lg' => 'px-6 py-3.5 text-lg'
    ];

    $variantClass = $variants[$variant] ?? $variants['primary'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => "$variantClass $sizeClass font-semibold rounded-xl transition-all duration-200 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed hover:scale-105 active:scale-95"
    ]) }}
    @if($disabled || $loading) disabled @endif
>
    @if($loading)
        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @elseif($icon)
        {!! $icon !!}
    @endif

    {{ $slot }}
</button>
