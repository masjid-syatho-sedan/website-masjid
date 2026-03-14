<?php

use App\Models\Artikel;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.base', ['active' => 'artikel'])] class extends Component {
    public Artikel $artikel;

    public string $slug = '';

    public function mount(string $slug): void
    {
        $this->artikel = Artikel::query()
            ->with(['kategori', 'tags', 'user'])
            ->diterbitkan()
            ->where('slug', $slug)
            ->firstOrFail();

        // Tambah view count
        $this->artikel->increment('dilihat');
    }

    #[Computed]
    public function artikelTerkait(): mixed
    {
        return Artikel::query()
            ->with(['kategori'])
            ->diterbitkan()
            ->where('id', '!=', $this->artikel->id)
            ->when($this->artikel->kategori_id, fn ($q) => $q->where('kategori_id', $this->artikel->kategori_id))
            ->latest('diterbitkan_pada')
            ->limit(3)
            ->get();
    }
}; ?>

<div>
    {{-- Breadcrumb --}}
    <nav class="bg-amber-50 border-b border-amber-100 py-3">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <ol class="flex items-center gap-2 text-sm text-amber-600">
                <li><a href="{{ route('home') }}" wire:navigate class="hover:text-amber-900 transition">Beranda</a></li>
                <li><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                <li><a href="{{ route('blog') }}" wire:navigate class="hover:text-amber-900 transition">Artikel</a></li>
                @if ($artikel->kategori)
                    <li><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                    <li><span class="font-semibold" style="color: {{ $artikel->kategori->warna }}">{{ $artikel->kategori->nama }}</span></li>
                @endif
                <li><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                <li class="text-amber-800 font-semibold truncate max-w-xs">{{ $artikel->judul }}</li>
            </ol>
        </div>
    </nav>

    {{-- Hero gambar --}}
    <div class="relative bg-gradient-to-br from-amber-700 to-amber-900 h-64 md:h-96 overflow-hidden">
        @if ($artikel->gambar)
            <img src="{{ asset('storage/'.$artikel->gambar) }}" alt="{{ $artikel->judul }}"
                 class="w-full h-full object-cover opacity-70">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-24 h-24 text-amber-200 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        @if ($artikel->unggulan)
            <div class="absolute top-4 right-4">
                <span class="px-3 py-1 bg-yellow-400 text-yellow-900 text-sm font-bold rounded-full">★ Artikel Unggulan</span>
            </div>
        @endif
    </div>

    {{-- Konten --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- Artikel utama --}}
            <article class="lg:col-span-2">
                {{-- Meta --}}
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    @if ($artikel->kategori)
                        <span class="px-3 py-1 text-sm font-bold rounded-full text-white" style="background-color: {{ $artikel->kategori->warna }}">
                            {{ $artikel->kategori->nama }}
                        </span>
                    @endif
                    <span class="text-sm text-amber-600">{{ $artikel->diterbitkan_pada?->translatedFormat('d F Y') }}</span>
                    <span class="text-amber-300">·</span>
                    <span class="text-sm text-amber-600">{{ number_format($artikel->dilihat) }} kali dilihat</span>
                    <span class="text-amber-300">·</span>
                    <span class="text-sm text-amber-600">Oleh {{ $artikel->user->name }}</span>
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-amber-900 leading-tight mb-6">
                    {{ $artikel->judul }}
                </h1>

                @if ($artikel->ringkasan)
                    <p class="text-lg text-amber-700 border-l-4 border-amber-400 pl-4 py-2 bg-amber-50 rounded-r-xl mb-8 italic">
                        {{ $artikel->ringkasan }}
                    </p>
                @endif

                {{-- Konten artikel --}}
                <div class="prose prose-amber max-w-none text-amber-900 leading-relaxed
                            prose-headings:text-amber-900 prose-a:text-amber-700 prose-strong:text-amber-900">
                    {!! nl2br(e($artikel->konten)) !!}
                </div>

                {{-- Tags --}}
                @if ($artikel->tags->isNotEmpty())
                    <div class="mt-10 pt-6 border-t border-amber-100">
                        <p class="text-sm font-bold text-amber-700 mb-3">Tag Terkait:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($artikel->tags as $tag)
                                <a href="{{ route('blog', ['tag' => $tag->slug]) }}" wire:navigate
                                   class="px-3 py-1.5 bg-amber-50 border border-amber-300 text-amber-700 hover:bg-amber-100 hover:border-amber-500 text-sm rounded-full transition font-medium">
                                    #{{ $tag->nama }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Navigasi --}}
                <div class="mt-10 pt-6 border-t border-amber-100">
                    <a href="{{ route('blog') }}" wire:navigate
                       class="inline-flex items-center gap-2 text-amber-700 hover:text-amber-900 font-semibold transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Kembali ke Daftar Artikel
                    </a>
                </div>
            </article>

            {{-- Sidebar --}}
            <aside class="lg:col-span-1 space-y-8">
                {{-- Info penulis --}}
                <div class="p-5 rounded-2xl bg-amber-50 border border-amber-200">
                    <h3 class="font-bold text-amber-900 mb-3 text-sm uppercase tracking-wide">Tentang Penulis</h3>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-amber-700 flex items-center justify-center text-white font-bold text-lg">
                            {{ $artikel->user->initials() }}
                        </div>
                        <div>
                            <p class="font-bold text-amber-900">{{ $artikel->user->name }}</p>
                            <p class="text-sm text-amber-600">Pengelola Konten</p>
                        </div>
                    </div>
                </div>

                {{-- Artikel terkait --}}
                @if ($this->artikelTerkait->isNotEmpty())
                    <div class="p-5 rounded-2xl bg-white border border-amber-200">
                        <h3 class="font-bold text-amber-900 mb-4 text-sm uppercase tracking-wide">Artikel Terkait</h3>
                        <div class="space-y-4">
                            @foreach ($this->artikelTerkait as $art)
                                <a href="{{ route('artikel.show', $art->slug) }}" wire:navigate class="group flex gap-3">
                                    <div class="w-16 h-14 flex-shrink-0 rounded-lg overflow-hidden bg-gradient-to-br from-amber-500 to-amber-700">
                                        @if ($art->gambar)
                                            <img src="{{ asset('storage/'.$art->gambar) }}" alt="{{ $art->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-amber-900 line-clamp-2 group-hover:text-amber-700 transition leading-snug">{{ $art->judul }}</p>
                                        <p class="text-xs text-amber-500 mt-1">{{ $art->diterbitkan_pada?->diffForHumans() }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </div>
</div>
