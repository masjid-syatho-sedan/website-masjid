<?php

use App\Models\AmbulanceJournal;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Jurnal Ambulans - Masjid Syatho Sedan')] #[Layout('layouts.base', ['active' => 'ambulans'])] class extends Component {
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
        $this->bulan = '';
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

    public bool $showModal = false;
    public ?string $activeJournalId = null;

    public function openDetail(string $id): void
    {
        $this->activeJournalId = $id;
        $this->showModal = true;
    }

    public function closeDetail(): void
    {
        $this->showModal = false;
        $this->activeJournalId = null;
    }

    #[Computed]
    public function activeJournal(): mixed
    {
        if (! $this->activeJournalId) {
            return null;
        }

        return AmbulanceJournal::with('driver')->find($this->activeJournalId);
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
    <section class="sticky top-0 z-20 bg-white border-b border-red-100 shadow-sm py-3">
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

                {{-- Month Filter (only when year selected) --}}
                @if ($tahun)
                    <select
                        wire:model.live="bulan"
                        class="text-sm rounded-lg border border-red-200 bg-red-50 text-red-800 px-3 py-2 focus:outline-none focus:border-red-400 focus:bg-white transition"
                    >
                        <option value="">Semua Bulan</option>
                        @foreach ($this->availableMonths as $num => $name)
                            <option value="{{ $num }}">{{ $name }}</option>
                        @endforeach
                    </select>
                @endif

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
                            <div
                                wire:click="openDetail('{{ $journal->id }}')"
                                class="group cursor-pointer bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-red-300 transition-all duration-200 overflow-hidden"
                            >
                                {{-- Cover image --}}
                                <div class="relative h-44 bg-gradient-to-br from-red-600 to-red-800 overflow-hidden">
                                    @if ($journal->images && count($journal->images) > 0)
                                        <img
                                            src="{{ asset('storage/'.$journal->images[0]) }}"
                                            alt="{{ $journal->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                        >
                                        @if (count($journal->images) > 1)
                                            <div class="absolute bottom-2 right-2 bg-black/60 text-white text-xs px-2 py-1 rounded-full font-medium">
                                                +{{ count($journal->images) - 1 }} foto
                                            </div>
                                        @endif
                                    @else
                                        <div class="w-full h-full flex items-center justify-center opacity-40">
                                            <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif

                                    {{-- Date badge --}}
                                    <div class="absolute top-3 left-3 bg-white/90 text-red-700 text-xs font-bold px-2.5 py-1 rounded-full shadow">
                                        {{ $journal->journal_date->translatedFormat('d M Y') }}
                                    </div>

                                    {{-- Video badge --}}
                                    @if ($journal->videos && count($journal->videos) > 0)
                                        <div class="absolute top-3 right-3 bg-red-600 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                            {{ count($journal->videos) }} video
                                        </div>
                                    @endif
                                </div>

                                {{-- Content --}}
                                <div class="p-5">
                                    {{-- Driver --}}
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="w-7 h-7 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                                            <span class="text-xs font-bold text-red-700">{{ $journal->driver?->initials() }}</span>
                                        </div>
                                        <span class="text-sm text-gray-600 font-medium">{{ $journal->driver?->name }}</span>
                                    </div>

                                    <h3 class="font-bold text-gray-900 text-base mb-2 line-clamp-2 group-hover:text-red-700 transition leading-snug">
                                        {{ $journal->title }}
                                    </h3>

                                    @if ($journal->description)
                                        <p class="text-sm text-gray-500 line-clamp-2 mb-3">{{ $journal->description }}</p>
                                    @endif

                                    {{-- Tasks preview --}}
                                    @if ($journal->tasks && count($journal->tasks) > 0)
                                        <div class="flex items-center gap-1.5 text-xs text-gray-500 border-t border-gray-100 pt-3">
                                            <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                            </svg>
                                            <span>{{ count($journal->tasks) }} tugas dilaksanakan</span>

                                            @if ($journal->links && count($journal->links) > 0)
                                                <span class="mx-1">·</span>
                                                <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                                </svg>
                                                <span>{{ count($journal->links) }} link</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
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

    {{-- ====== DETAIL MODAL ====== --}}
    @if ($showModal && $this->activeJournal)
        <div
            wire:click.self="closeDetail"
            class="fixed inset-0 z-50 flex items-start justify-center bg-black/60 backdrop-blur-sm p-4 overflow-y-auto"
        >
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl my-8">
                {{-- Close button --}}
                <button
                    wire:click="closeDetail"
                    class="absolute top-4 right-4 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 transition"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                {{-- Header --}}
                <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-t-2xl p-6 text-white">
                    <div class="flex items-center gap-2 text-red-200 text-sm mb-3">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20 8h-3V6c0-1.1-.9-2-2-2H9C7.9 4 7 4.9 7 6v2H4c-1.1 0-2 .9-2 2v9c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-9c0-1.1-.9-2-2-2z"/></svg>
                        {{ $this->activeJournal->journal_date->translatedFormat('l, d F Y') }}
                    </div>
                    <h2 class="text-2xl font-bold leading-snug">{{ $this->activeJournal->title }}</h2>
                    <div class="flex items-center gap-2 mt-3">
                        <div class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center">
                            <span class="text-xs font-bold">{{ $this->activeJournal->driver?->initials() }}</span>
                        </div>
                        <span class="text-sm text-red-100">Driver: {{ $this->activeJournal->driver?->name }}</span>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Description --}}
                    @if ($this->activeJournal->description)
                        <div>
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-2">Deskripsi</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $this->activeJournal->description }}</p>
                        </div>
                    @endif

                    {{-- Tasks --}}
                    @if ($this->activeJournal->tasks && count($this->activeJournal->tasks) > 0)
                        <div>
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">Daftar Tugas</h3>
                            <ul class="space-y-2">
                                @foreach ($this->activeJournal->tasks as $task)
                                    <li class="flex items-start gap-3">
                                        <div class="w-5 h-5 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-3 h-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                        </div>
                                        <span class="text-gray-700">{{ $task['task'] ?? $task }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Images --}}
                    @if ($this->activeJournal->images && count($this->activeJournal->images) > 0)
                        <div>
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">
                                Foto Dokumentasi ({{ count($this->activeJournal->images) }})
                            </h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach ($this->activeJournal->images as $image)
                                    <a href="{{ asset('storage/'.$image) }}" target="_blank" class="block rounded-lg overflow-hidden h-32 bg-gray-100 hover:opacity-90 transition">
                                        <img src="{{ asset('storage/'.$image) }}" alt="Foto" class="w-full h-full object-cover">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Videos --}}
                    @if ($this->activeJournal->videos && count($this->activeJournal->videos) > 0)
                        <div>
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">
                                Video Dokumentasi ({{ count($this->activeJournal->videos) }})
                            </h3>
                            <div class="space-y-3">
                                @foreach ($this->activeJournal->videos as $video)
                                    <video
                                        controls
                                        class="w-full rounded-xl bg-black max-h-64"
                                        preload="metadata"
                                    >
                                        <source src="{{ asset('storage/'.$video) }}">
                                        Browser Anda tidak mendukung pemutaran video.
                                    </video>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Links --}}
                    @if ($this->activeJournal->links && count($this->activeJournal->links) > 0)
                        <div>
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">Tautan</h3>
                            <div class="flex flex-col gap-2">
                                @foreach ($this->activeJournal->links as $link)
                                    <a
                                        href="{{ $link['url'] }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 hover:border-red-300 hover:bg-red-50 transition group"
                                    >
                                        <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700 group-hover:text-red-700 transition min-w-0 truncate">
                                            {{ $link['label'] ?? $link['url'] }}
                                        </span>
                                        <svg class="w-4 h-4 text-gray-400 ml-auto flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
