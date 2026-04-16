<?php

use App\Models\GeneralJournal;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Jurnal Umum - Masjid Syatho Sedan')] #[Layout('layouts.base', ['active' => 'jurnal'])] class extends Component {
    public GeneralJournal $journal;

    public function mount(string $id): void
    {
        $this->journal = GeneralJournal::published()->findOrFail($id);
    }
}; ?>

<div>
    @push('og-meta')
        <meta property="og:title" content="{{ $journal->title }} — Jurnal Umum Masjid Syatho Sedan" />
        <meta property="og:description" content="{{ $journal->description ? Str::limit($journal->description, 160) : 'Jurnal kegiatan Masjid Syatho Sedan, '.$journal->journal_date->translatedFormat('d F Y') }}" />
        <meta property="og:url" content="{{ route('jurnal.show', $journal->id) }}" />
        <meta property="og:type" content="article" />
    @endpush

    {{-- ====== HERO ====== --}}
    <section class="relative bg-gradient-to-br from-teal-700 via-teal-600 to-teal-800 overflow-hidden py-14 md:py-18">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full -mr-48 -mt-48"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full -ml-48 -mb-48"></div>
        </div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-teal-200 mb-6 flex-wrap">
                <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('jurnal.index') }}" class="hover:text-white transition">Jurnal Umum</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-semibold truncate max-w-xs">{{ $journal->title }}</span>
            </nav>

            <div class="flex items-center gap-3 text-teal-200 text-sm mb-4">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $journal->journal_date->translatedFormat('l, d F Y') }}
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-white leading-snug">{{ $journal->title }}</h1>
        </div>
    </section>

    {{-- ====== CONTENT ====== --}}
    <section class="py-10 bg-white min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back button + Copy link --}}
            <div class="flex items-center justify-between mb-8">
                <a
                    href="{{ route('jurnal.index') }}"
                    class="inline-flex items-center gap-2 text-sm text-teal-600 hover:text-teal-800 font-semibold transition"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Kembali ke Jurnal
                </a>

                <button
                    x-data="{ copied: false }"
                    x-on:click="navigator.clipboard.writeText(window.location.href).then(() => { copied = true; setTimeout(() => copied = false, 2000) })"
                    class="inline-flex items-center gap-2 text-sm font-semibold px-3 py-2 rounded-lg border transition"
                    x-bind:class="copied ? 'border-green-300 bg-green-50 text-green-700' : 'border-gray-200 bg-white text-gray-600 hover:border-teal-300 hover:text-teal-700'"
                >
                    <template x-if="!copied">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </template>
                    <template x-if="copied">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </template>
                    <span x-text="copied ? 'Tersalin!' : 'Salin Link'"></span>
                </button>
            </div>

            <div class="space-y-8">
                {{-- Description --}}
                @if ($journal->description)
                    <div>
                        <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-2">Deskripsi</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $journal->description }}</p>
                    </div>
                @endif

                {{-- Tasks --}}
                @if ($journal->tasks && count($journal->tasks) > 0)
                    <div>
                        <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">Daftar Kegiatan</h2>
                        <ul class="space-y-2">
                            @foreach ($journal->tasks as $task)
                                <li class="flex items-start gap-3">
                                    <div class="w-5 h-5 rounded-full bg-teal-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span class="text-gray-700">{{ $task['task'] ?? $task }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Images --}}
                @if ($journal->images && count($journal->images) > 0)
                    <div>
                        <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">
                            Foto Dokumentasi ({{ count($journal->images) }})
                        </h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach ($journal->images as $image)
                                <a href="{{ asset('storage/'.$image) }}" target="_blank" class="block rounded-xl overflow-hidden h-40 bg-gray-100 hover:opacity-90 transition">
                                    <img src="{{ asset('storage/'.$image) }}" alt="Foto" class="w-full h-full object-cover">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Videos --}}
                @if ($journal->videos && count($journal->videos) > 0)
                    <div>
                        <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">
                            Video Dokumentasi ({{ count($journal->videos) }})
                        </h2>
                        <div class="space-y-4">
                            @foreach ($journal->videos as $video)
                                <video
                                    controls
                                    class="w-full rounded-xl bg-black max-h-96"
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
                @if ($journal->links && count($journal->links) > 0)
                    <div>
                        <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">Tautan</h2>
                        <div class="flex flex-col gap-2">
                            @foreach ($journal->links as $link)
                                <a
                                    href="{{ $link['url'] }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 hover:border-teal-300 hover:bg-teal-50 transition group"
                                >
                                    <div class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700 group-hover:text-teal-700 transition min-w-0 truncate">
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
    </section>
</div>
