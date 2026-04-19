<?php

use App\Models\AmbulanceJournal;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Jurnal Ambulans - Masjid Syatho Sedan')] #[Layout('layouts.base', ['active' => 'ambulans', 'whatsappPhone' => '6282147977779', 'whatsappLabel' => 'Hubungi Ambulans'])] class extends Component {
    use WithPagination;

    #[Url(as: 'cari', except: '')]
    public string $cari = '';

    #[Url(as: 'driver', except: '')]
    public string $driverId = '';

    #[Url(as: 'tahun', except: '')]
    public string $tahun = '';

    #[Url(as: 'bulan', except: '')]
    public string $bulan = '';

    public function updatedCari(): void
    {
        $this->resetPage();
    }

    public function updatedDriverId(): void
    {
        $this->resetPage();
    }

    public function updatedTahun(): void
    {
        $this->resetPage();
    }

    public function updatedBulan(): void
    {
        $this->resetPage();
    }

    public function resetFilter(): void
    {
        $this->cari = '';
        $this->driverId = '';
        $this->tahun = '';
        $this->bulan = '';
        $this->resetPage();
    }

    #[Computed]
    public function journals(): mixed
    {
        return AmbulanceJournal::query()
            ->with('driver')
            ->published()
            ->when($this->cari, fn ($q) => $q->where(function ($q) {
                $q->where('title', 'like', '%'.$this->cari.'%')
                    ->orWhere('description', 'like', '%'.$this->cari.'%');
            }))
            ->when($this->driverId, fn ($q) => $q->where('user_id', $this->driverId))
            ->when($this->tahun, fn ($q) => $q->whereYear('journal_date', $this->tahun))
            ->when($this->bulan, fn ($q) => $q->whereMonth('journal_date', $this->bulan))
            ->latest('journal_date')
            ->paginate(9);
    }

    #[Computed]
    public function drivers(): mixed
    {
        return User::whereHas('ambulanceJournals', fn ($q) => $q->published())
            ->orderBy('name')
            ->get();
    }

    #[Computed]
    public function availableYears(): array
    {
        return AmbulanceJournal::published()
            ->selectRaw('YEAR(journal_date) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->map(fn ($y) => (string) $y)
            ->toArray();
    }

    #[Computed]
    public function availableMonths(): array
    {
        return [
            '1' => 'Januari', '2' => 'Februari', '3' => 'Maret',
            '4' => 'April', '5' => 'Mei', '6' => 'Juni',
            '7' => 'Juli', '8' => 'Agustus', '9' => 'September',
            '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
        ];
    }

}; ?>

<div>
    {{-- ====== HERO ====== --}}
    <section class="relative bg-gradient-to-br from-red-700 via-red-600 to-red-800 overflow-hidden py-16 md:py-20">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full -mr-48 -mt-48"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full -ml-48 -mb-48"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-red-200 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('fasilitas') }}" class="hover:text-white transition">Fasilitas</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('fasilitas.ambulans') }}" class="hover:text-white transition">Ambulans</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-semibold">Jurnal</span>
            </nav>

            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="flex-1 text-white">
                    <div class="inline-flex items-center gap-2 bg-red-900/40 text-red-100 text-sm font-semibold px-4 py-2 rounded-full mb-5">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 8h-3V6c0-1.1-.9-2-2-2H9C7.9 4 7 4.9 7 6v2H4c-1.1 0-2 .9-2 2v9c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-9c0-1.1-.9-2-2-2zm-5 9h-2v-2h-2v2H9v-2H7v-2h2v-2h2v2h2v-2h2v2h2v2h-2v2zm0-11H9V6h6v2z"/>
                        </svg>
                        Dokumentasi Operasional
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                        Jurnal Ambulans
                        <br><span class="text-red-200">Masjid Syatho</span>
                    </h1>
                    <p class="text-lg text-red-100 max-w-xl">
                        Catatan lengkap setiap perjalanan dan tugas ambulans, dilengkapi foto, video, serta dokumentasi lapangan.
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-36 h-36 bg-red-900/30 rounded-3xl flex items-center justify-center border-2 border-red-400/30">
                        <svg class="w-20 h-20 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ====== FILTER BAR ====== --}}
    <section class="bg-white border-b border-red-100 shadow-sm py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                {{-- Search --}}
                <div class="relative flex-1 min-w-0">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input
                        wire:model.live.debounce.400ms="cari"
                        type="text"
                        placeholder="Cari jurnal..."
                        class="w-full pl-9 pr-4 py-2 text-sm rounded-lg border border-red-200 bg-red-50 text-red-900 placeholder-red-400 focus:outline-none focus:border-red-400 focus:bg-white transition"
                    >
                    @if ($cari)
                        <button wire:click="$set('cari', '')" class="absolute right-3 top-1/2 -translate-y-1/2 text-red-400 hover:text-red-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    @endif
                </div>

                {{-- Driver Filter --}}
                <select
                    wire:model.live="driverId"
                    class="text-sm rounded-lg border border-red-200 bg-red-50 text-red-800 px-3 py-2 focus:outline-none focus:border-red-400 focus:bg-white transition"
                >
                    <option value="">Semua Driver</option>
                    @foreach ($this->drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                    @endforeach
                </select>

                {{-- Year Filter --}}
                <select
                    wire:model.live="tahun"
                    class="text-sm rounded-lg border border-red-200 bg-red-50 text-red-800 px-3 py-2 focus:outline-none focus:border-red-400 focus:bg-white transition"
                >
                    <option value="">Semua Tahun</option>
                    @foreach ($this->availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>

                {{-- Month Filter --}}
                <select
                    wire:model.live="bulan"
                    class="text-sm rounded-lg border border-red-200 bg-red-50 text-red-800 px-3 py-2 focus:outline-none focus:border-red-400 focus:bg-white transition"
                >
                    <option value="">Semua Bulan</option>
                    @foreach ($this->availableMonths as $num => $name)
                        <option value="{{ $num }}">{{ $name }}</option>
                    @endforeach
                </select>

                {{-- Reset --}}
                @if ($cari || $driverId || $tahun || $bulan)
                    <button
                        wire:click="resetFilter"
                        class="flex-shrink-0 flex items-center gap-1.5 text-sm text-red-700 hover:text-red-900 font-semibold border border-red-300 hover:border-red-500 px-3 py-2 rounded-lg transition"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Reset
                    </button>
                @endif
            </div>
        </div>
    </section>

    {{-- ====== JOURNAL LIST ====== --}}
    <section class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header count --}}
            <div class="flex items-center gap-3 mb-8">
                <div class="h-8 w-1 bg-red-600 rounded-full"></div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        @if ($cari)
                            Hasil Pencarian: "{{ $cari }}"
                        @elseif ($driverId)
                            Jurnal Driver: {{ $this->drivers->firstWhere('id', $driverId)?->name ?? '-' }}
                        @elseif ($tahun && $bulan)
                            {{ $this->availableMonths[$bulan] ?? '' }} {{ $tahun }}
                        @elseif ($tahun)
                            Tahun {{ $tahun }}
                        @else
                            Semua Jurnal
                        @endif
                    </h2>
                    <p class="text-sm text-gray-500 mt-0.5">{{ $this->journals->total() }} jurnal ditemukan</p>
                </div>
            </div>

            {{-- Loading state --}}
            <div wire:loading.class="opacity-50 pointer-events-none" wire:target="cari,driverId,tahun,bulan">
                @if ($this->journals->isEmpty())
                    <div class="text-center py-24">
                        <svg class="w-16 h-16 mx-auto text-red-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="text-xl font-bold text-gray-700 mb-2">Jurnal Tidak Ditemukan</h3>
                        <p class="text-gray-500 mb-6">Coba ubah filter atau kata kunci pencarian</p>
                        <button wire:click="resetFilter" class="px-6 py-3 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 transition">
                            Lihat Semua Jurnal
                        </button>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($this->journals as $journal)
                            <a
                                href="{{ route('fasilitas.ambulans.jurnal.show', $journal->id) }}"
                                class="group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-red-300 transition-all duration-200 overflow-hidden flex flex-col"
                            >
                                {{-- Content --}}
                                <div class="p-5 flex flex-col flex-1">
                                    {{-- Date --}}
                                    <div class="flex items-center gap-2 mb-3">
                                        <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-sm text-red-700 font-semibold">{{ $journal->journal_date->translatedFormat('d F Y') }}</span>
                                    </div>

                                    <h3 class="font-bold text-gray-900 text-base mb-2 line-clamp-2 group-hover:text-red-700 transition leading-snug">
                                        {{ $journal->title }}
                                    </h3>

                                    @if ($journal->description)
                                        <p class="text-sm text-gray-500 line-clamp-2 mb-3">{{ $journal->description }}</p>
                                    @endif

                                    {{-- Meta --}}
                                    <div class="flex items-center gap-3 text-xs text-gray-500 border-t border-gray-100 pt-3 mt-auto flex-wrap">
                                        @if ($journal->tasks && count($journal->tasks) > 0)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                                </svg>
                                                {{ count($journal->tasks) }} tugas
                                            </span>
                                        @endif
                                        @if ($journal->videos && count($journal->videos) > 0)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                                {{ count($journal->videos) }} video
                                            </span>
                                        @endif
                                        @if ($journal->links && count($journal->links) > 0)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                                </svg>
                                                {{ count($journal->links) }} link
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if ($this->journals->hasPages())
                        <div class="mt-12 flex justify-center">
                            {{ $this->journals->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </section>

</div>
