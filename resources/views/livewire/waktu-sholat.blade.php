<div class="bg-white border border-amber-200 rounded-2xl p-6 shadow-sm">

    <div class="flex items-center justify-between mb-4">
        <div class="font-['Playfair_Display'] text-sm font-bold text-amber-900">
            Jadwal Sholat Hari Ini
        </div>
        <div class="text-xs text-amber-600 font-medium">
            {{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
        </div>
    </div>

    <div class="space-y-2">
        @foreach ($timings as $name => $time)
            @if ($name !== 'Syuruq')
                <div
                    class="flex items-center justify-between px-3 py-2 rounded-lg transition
                    {{ $currentPrayer === $name ? 'bg-amber-100 border border-amber-300' : 'bg-amber-50' }}">
                    <div class="flex items-center gap-2">
                        @if ($currentPrayer === $name)
                            <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                        @endif
                        <span
                            class="text-sm font-semibold {{ $currentPrayer === $name ? 'text-amber-900' : 'text-amber-800' }}">
                            {{ $name }}
                        </span>
                    </div>
                    <span
                        class="font-['Playfair_Display'] font-bold {{ $currentPrayer === $name ? 'text-amber-700' : 'text-amber-600' }}">
                        {{ $time }}
                    </span>
                </div>
            @endif
        @endforeach
    </div>

    <div class="mt-3 pt-3 border-t border-amber-100 flex items-center gap-1.5 text-xs text-amber-500">
        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                clip-rule="evenodd" />
        </svg>
        Sedan, Kab. Rembang
    </div>

</div>
