@props([
    'headers' => [],
    'responsive' => true,
    'hoverable' => true,
    'striped' => false
])

<div class="{{ $responsive ? 'overflow-x-auto' : '' }} rounded-xl border border-slate-200 shadow-sm">
    <table class="min-w-full divide-y divide-slate-200">
        @if(!empty($headers))
            <thead class="bg-slate-50">
                <tr>
                    @foreach($headers as $header)
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider whitespace-nowrap">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>
        @endif

        <tbody class="bg-white divide-y divide-slate-200">
            {{ $slot }}
        </tbody>
    </table>
</div>

<style>
    @if($hoverable)
    tbody tr {
        transition: all 0.15s ease;
    }

    tbody tr:hover {
        background-color: #f8fafc;
        transform: scale(1.002);
    }
    @endif

    @if($striped)
    tbody tr:nth-child(even) {
        background-color: #f8fafc;
    }
    @endif
</style>
