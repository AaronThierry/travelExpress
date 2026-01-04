@props([
    'title' => 'Stat Title',
    'value' => '0',
    'icon' => 'chart',
    'color' => 'indigo',
    'trend' => null,
    'trendUp' => true,
    'animate' => false,
    'valueId' => null
])

@php
    $colors = [
        'indigo' => 'from-indigo-500 to-indigo-600',
        'purple' => 'from-purple-500 to-purple-600',
        'blue' => 'from-blue-500 to-blue-600',
        'green' => 'from-green-500 to-green-600',
        'yellow' => 'from-yellow-500 to-yellow-600',
        'red' => 'from-red-500 to-red-600',
        'pink' => 'from-pink-500 to-pink-600',
        'orange' => 'from-orange-500 to-orange-600',
    ];

    $iconColors = [
        'indigo' => 'text-indigo-600',
        'purple' => 'text-purple-600',
        'blue' => 'text-blue-600',
        'green' => 'text-green-600',
        'yellow' => 'text-yellow-600',
        'red' => 'text-red-600',
        'pink' => 'text-pink-600',
        'orange' => 'text-orange-600',
    ];

    $bgColors = [
        'indigo' => 'bg-indigo-50',
        'purple' => 'bg-purple-50',
        'blue' => 'bg-blue-50',
        'green' => 'bg-green-50',
        'yellow' => 'bg-yellow-50',
        'red' => 'bg-red-50',
        'pink' => 'bg-pink-50',
        'orange' => 'bg-orange-50',
    ];

    $gradient = $colors[$color] ?? $colors['indigo'];
    $iconColor = $iconColors[$color] ?? $iconColors['indigo'];
    $bgColor = $bgColors[$color] ?? $bgColors['indigo'];
@endphp

<div class="elegant-card p-6 hover-lift group">
    <div class="flex items-start justify-between">
        <div class="flex-1">
            <p class="text-sm font-medium text-slate-600 mb-2">{{ $title }}</p>
            <h3 class="text-3xl font-bold text-slate-900 mb-3 transition-all group-hover:scale-105"
                @if($valueId) id="{{ $valueId }}" @endif>
                {{ $value }}
            </h3>

            @if($trend)
                <div class="flex items-center gap-1">
                    @if($trendUp)
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                        </svg>
                        <span class="text-sm font-medium text-green-600">{{ $trend }}</span>
                    @else
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                        <span class="text-sm font-medium text-red-600">{{ $trend }}</span>
                    @endif
                    <span class="text-sm text-slate-500 ml-1">vs dernier mois</span>
                </div>
            @endif
        </div>

        <div class="w-14 h-14 {{ $bgColor }} rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
            {{ $slot->isEmpty() ?
                '<svg class="w-7 h-7 ' . $iconColor . '" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>' :
                $slot
            }}
        </div>
    </div>

    <!-- Progress bar (optional) -->
    <div class="mt-4 h-1.5 bg-slate-100 rounded-full overflow-hidden">
        <div class="h-full bg-gradient-to-r {{ $gradient }} rounded-full transition-all duration-500" style="width: 70%"></div>
    </div>
</div>

<style>
    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    }
</style>
