<?php

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Tag;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Blog & Artikel')] #[Layout('layouts.base', ['active' => 'artikel'])] class extends Component {
    use WithPagination;

    #[Url(as: 'cari', except: '')]
    public string $cari = '';

    #[Url(as: 'kategori', except: '')]
    public string $kategoriSlug = '';

    #[Url(as: 'tag', except: '')]
    public string $tagSlug = '';

    public function updatedCari(): void
    {
        $this->resetPage();
    }

    public function updatedKategoriSlug(): void
    {
        $this->resetPage();
    }

    public function updatedTagSlug(): void
    {
        $this->resetPage();
    }

    public function filterKategori(string $slug): void
    {
        $this->kategoriSlug = ($this->kategoriSlug === $slug) ? '' : $slug;
        $this->tagSlug = '';
        $this->resetPage();
    }

    public function filterTag(string $slug): void
    {
        $this->tagSlug = ($this->tagSlug === $slug) ? '' : $slug;
        $this->resetPage();
    }

    public function resetFilter(): void
    {
        $this->cari = '';
        $this->kategoriSlug = '';
        $this->tagSlug = '';
        $this->resetPage();
    }

    #[Computed]
    public function artikelUnggulan(): mixed
    {
        return Artikel::query()
            ->with(['kategori', 'user'])
            ->diterbitkan()
            ->unggulan()
            ->latest('diterbitkan_pada')
            ->limit(3)
            ->get();
    }

    #[Computed]
    public function artikels(): mixed
    {
        return Artikel::query()
            ->with(['kategori', 'tags', 'user'])
            ->diterbitkan()
            ->when($this->cari, fn ($q) => $q->where(function ($q) {
                $q->where('judul', 'like', '%'.$this->cari.'%')
                    ->orWhere('ringkasan', 'like', '%'.$this->cari.'%');
            }))
            ->when($this->kategoriSlug, fn ($q) => $q->whereHas(
                'kategori',
                fn ($q) => $q->where('slug', $this->kategoriSlug)
            ))
            ->when($this->tagSlug, fn ($q) => $q->whereHas(
                'tags',
                fn ($q) => $q->where('slug', $this->tagSlug)
            ))
            ->latest('diterbitkan_pada')
            ->paginate(9);
    }

    #[Computed]
    public function kategoris(): mixed
    {
        return Kategori::whereHas('artikels', fn ($q) => $q->diterbitkan())
            ->withCount(['artikels' => fn ($q) => $q->diterbitkan()])
            ->orderByDesc('artikels_count')
            ->get();
    }

    #[Computed]
    public function tags(): mixed
    {
        return Tag::whereHas('artikels', fn ($q) => $q->diterbitkan())
            ->withCount(['artikels' => fn ($q) => $q->diterbitkan()])
            ->orderByDesc('artikels_count')
            ->limit(20)
            ->get();
    }
}; ?>

<div>
    {{-- ====== HERO ====== --}}
    <section class="relative bg-gradient-to-br from-amber-700 via-amber-600 to-amber-800 overflow-hidden py-20">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full -mr-48 -mt-48"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full -ml-48 -mb-48"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 bg-white/20 text-white text-sm font-semibold px-4 py-2 rounded-full mb-6">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"/></svg>
                Blog & Artikel Islami
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Inspirasi & Ilmu<br><span class="text-amber-200">Untuk Kehidupan Lebih Baik</span>
            </h1>
            <p class="text-xl text-amber-100 max-w-2xl mx-auto mb-8">
                Baca artikel inspiratif, tips ibadah, dan berita terkini dari Masjid Syatho
            </p>

            {{-- Search --}}
            <div class="max-w-xl mx-auto">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input
                        wire:model.live.debounce.400ms="cari"
                        type="text"
                        placeholder="Cari artikel..."
                        class="w-full pl-12 pr-4 py-4 rounded-2xl bg-white/95 text-amber-900 placeholder-amber-400 border-2 border-white/50 focus:border-amber-300 focus:outline-none shadow-xl text-base"
                    >
                    @if ($cari)
                        <button wire:click="$set('cari', '')" class="absolute right-4 top-1/2 -translate-y-1/2 text-amber-400 hover:text-amber-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ====== FILTER KATEGORI ====== --}}
    <section class="sticky top-0 z-20 bg-white border-b border-amber-100 shadow-sm py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 overflow-x-auto pb-1 scrollbar-hide">
                <button
                    wire:click="resetFilter"
                    class="flex-shrink-0 px-4 py-2 rounded-full text-sm font-semibold transition {{ !$kategoriSlug && !$tagSlug && !$cari ? 'bg-amber-700 text-white shadow' : 'bg-amber-50 text-amber-700 hover:bg-amber-100' }}"
                >
                    Semua
                </button>
                @foreach ($this->kategoris as $kat)
                    <button
                        wire:click="filterKategori('{{ $kat->slug }}')"
                        class="flex-shrink-0 px-4 py-2 rounded-full text-sm font-semibold transition {{ $kategoriSlug === $kat->slug ? 'bg-amber-700 text-white shadow' : 'bg-amber-50 text-amber-700 hover:bg-amber-100' }}"
                    >
                        {{ $kat->nama }}
                        <span class="ml-1 text-xs opacity-70">({{ $kat->artikels_count }})</span>
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ====== ARTIKEL UNGGULAN ====== --}}
    @if ($this->artikelUnggulan->isNotEmpty() && !$cari && !$kategoriSlug && !$tagSlug)
        <section class="py-12 bg-gradient-to-b from-amber-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="h-8 w-1 bg-amber-600 rounded-full"></div>
                    <h2 class="text-3xl font-bold text-amber-900">Artikel Unggulan</h2>
                    <span class="px-3 py-1 bg-amber-100 text-amber-700 text-sm font-bold rounded-full">Featured</span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    @php $utama = $this->artikelUnggulan->first(); @endphp

                    {{-- Artikel utama --}}
                    <div class="lg:col-span-2">
                        <a href="{{ route('artikel.show', $utama->slug) }}" class="block group rounded-2xl overflow-hidden bg-white shadow-xl border-2 border-amber-100 hover:shadow-2xl hover:border-amber-400 transition">
                            <div class="relative overflow-hidden h-72 bg-gradient-to-br from-amber-600 to-amber-800">
                                @if ($utama->gambar)
                                    <img src="{{ asset('storage/'.$utama->gambar) }}" alt="{{ $utama->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-20 h-20 text-amber-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                <div class="absolute bottom-4 left-4">
                                    @if ($utama->kategori)
                                        <span class="px-3 py-1 text-xs font-bold rounded-full text-white" style="background-color: {{ $utama->kategori->warna }}">
                                            {{ $utama->kategori->nama }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-3 text-sm text-amber-600 mb-3">
                                    <span>{{ $utama->diterbitkan_pada?->translatedFormat('d F Y') }}</span>
                                    <span>·</span>
                                    <span>{{ number_format($utama->dilihat) }} kali dilihat</span>
                                </div>
                                <h3 class="text-2xl font-bold text-amber-900 mb-3 group-hover:text-amber-700 transition leading-tight">
                                    {{ $utama->judul }}
                                </h3>
                                <p class="text-amber-700 leading-relaxed line-clamp-3">{{ $utama->ringkasan }}</p>
                            </div>
                        </a>
                    </div>

                    {{-- Artikel unggulan lainnya --}}
                    <div class="flex flex-col gap-5">
                        @foreach ($this->artikelUnggulan->skip(1) as $art)
                            <a href="{{ route('artikel.show', $art->slug) }}" class="group flex gap-4 rounded-xl overflow-hidden bg-white shadow border border-amber-100 hover:shadow-lg hover:border-amber-300 transition p-4">
                                <div class="w-24 h-20 flex-shrink-0 rounded-lg overflow-hidden bg-gradient-to-br from-amber-500 to-amber-700">
                                    @if ($art->gambar)
                                        <img src="{{ asset('storage/'.$art->gambar) }}" alt="{{ $art->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    @if ($art->kategori)
                                        <span class="text-xs font-bold" style="color: {{ $art->kategori->warna }}">{{ $art->kategori->nama }}</span>
                                    @endif
                                    <h4 class="text-sm font-bold text-amber-900 mt-1 line-clamp-2 group-hover:text-amber-700 transition">{{ $art->judul }}</h4>
                                    <p class="text-xs text-amber-500 mt-1">{{ $art->diterbitkan_pada?->diffForHumans() }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ====== SEMUA ARTIKEL ====== --}}
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header section --}}
            <div class="flex items-center justify-between mb-8 flex-wrap gap-4">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-1 bg-amber-600 rounded-full"></div>
                        <h2 class="text-3xl font-bold text-amber-900">
                            @if ($cari)
                                Hasil Pencarian: "{{ $cari }}"
                            @elseif ($kategoriSlug)
                                Kategori: {{ $this->kategoris->firstWhere('slug', $kategoriSlug)?->nama ?? $kategoriSlug }}
                            @elseif ($tagSlug)
                                Tag: #{{ $tagSlug }}
                            @else
                                Artikel Terbaru
                            @endif
                        </h2>
                    </div>
                    <p class="text-amber-600 mt-1 ml-4">{{ $this->artikels->total() }} artikel ditemukan</p>
                </div>

                @if ($cari || $kategoriSlug || $tagSlug)
                    <button wire:click="resetFilter" class="flex items-center gap-2 text-sm text-amber-700 hover:text-amber-900 font-semibold border border-amber-300 hover:border-amber-500 px-4 py-2 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Reset Filter
                    </button>
                @endif
            </div>

            {{-- Tags cloud --}}
            @if ($this->tags->isNotEmpty() && !$cari)
                <div class="flex flex-wrap gap-2 mb-8">
                    @foreach ($this->tags as $tag)
                        <button
                            wire:click="filterTag('{{ $tag->slug }}')"
                            class="px-3 py-1 text-xs rounded-full border transition font-medium {{ $tagSlug === $tag->slug ? 'bg-amber-700 text-white border-amber-700' : 'border-amber-300 text-amber-700 hover:bg-amber-50' }}"
                        >
                            #{{ $tag->nama }}
                        </button>
                    @endforeach
                </div>
            @endif

            {{-- Loading state --}}
            <div wire:loading.class="opacity-50 pointer-events-none" wire:target="cari,kategoriSlug,tagSlug">
                @if ($this->artikels->isEmpty())
                    <div class="text-center py-20">
                        <svg class="w-16 h-16 mx-auto text-amber-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="text-xl font-bold text-amber-800 mb-2">Artikel Tidak Ditemukan</h3>
                        <p class="text-amber-600 mb-6">Coba kata kunci atau filter yang berbeda</p>
                        <button wire:click="resetFilter" class="px-6 py-3 bg-amber-700 text-white font-semibold rounded-xl hover:bg-amber-800 transition">
                            Lihat Semua Artikel
                        </button>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($this->artikels as $art)
                            <a href="{{ route('artikel.show', $art->slug) }}" wire:navigate
                               class="group block rounded-xl overflow-hidden bg-white shadow border border-amber-100 hover:shadow-xl hover:border-amber-300 transition">
                                <div class="relative h-48 bg-gradient-to-br from-amber-500 to-amber-700 overflow-hidden">
                                    @if ($art->gambar)
                                        <img src="{{ asset('storage/'.$art->gambar) }}" alt="{{ $art->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center opacity-40">
                                            <svg class="w-14 h-14 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        </div>
                                    @endif
                                    @if ($art->kategori)
                                        <div class="absolute top-3 left-3">
                                            <span class="px-3 py-1 text-xs font-bold rounded-full text-white" style="background-color: {{ $art->kategori->warna }}">
                                                {{ $art->kategori->nama }}
                                            </span>
                                        </div>
                                    @endif
                                    @if ($art->unggulan)
                                        <div class="absolute top-3 right-3">
                                            <span class="px-2 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full">★ Unggulan</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-5">
                                    <div class="flex items-center gap-2 text-xs text-amber-500 mb-2">
                                        <span>{{ $art->diterbitkan_pada?->translatedFormat('d M Y') }}</span>
                                        <span>·</span>
                                        <span>{{ number_format($art->dilihat) }} dilihat</span>
                                    </div>
                                    <h3 class="font-bold text-amber-900 mb-2 line-clamp-2 group-hover:text-amber-700 transition leading-snug">
                                        {{ $art->judul }}
                                    </h3>
                                    <p class="text-sm text-amber-700 line-clamp-3 mb-4">{{ $art->ringkasan }}</p>
                                    @if ($art->tags->isNotEmpty())
                                        <div class="flex flex-wrap gap-1">
                                            @foreach ($art->tags->take(3) as $tag)
                                                <span class="px-2 py-0.5 bg-amber-50 border border-amber-200 text-amber-600 text-xs rounded-full">#{{ $tag->nama }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="mt-4 flex items-center gap-2 text-amber-700 font-semibold text-sm group-hover:text-amber-900 transition">
                                        Baca Selengkapnya
                                        <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if ($this->artikels->hasPages())
                        <div class="mt-12 flex justify-center">
                            {{ $this->artikels->links('vendor.pagination.tailwind') }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </section>
</div>
