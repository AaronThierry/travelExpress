@props([
    'id' => 'modal',
    'title' => 'Modal Title',
    'size' => 'md', // sm, md, lg, xl, full
    'closeButton' => true,
    'footer' => true
])

@php
    $sizes = [
        'sm' => 'max-w-md',
        'md' => 'max-w-2xl',
        'lg' => 'max-w-4xl',
        'xl' => 'max-w-6xl',
        'full' => 'max-w-7xl'
    ];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<div id="{{ $id }}" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white rounded-2xl {{ $sizeClass }} w-full shadow-2xl transform transition-all my-8 animate-modal-in">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-slate-200">
            <h2 class="text-2xl font-bold text-slate-900">{{ $title }}</h2>
            @if($closeButton)
                <button onclick="document.getElementById('{{ $id }}').classList.add('hidden')"
                    class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            @endif
        </div>

        <!-- Modal Body -->
        <div class="p-6 max-h-[calc(100vh-200px)] overflow-y-auto custom-scrollbar">
            {{ $slot }}
        </div>

        <!-- Modal Footer (Optional) -->
        @if(isset($actions))
            <div class="flex items-center justify-end gap-3 p-6 border-t border-slate-200 bg-slate-50 rounded-b-2xl">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>

<style>
    @keyframes modal-in {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-modal-in {
        animation: modal-in 0.2s ease-out;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
