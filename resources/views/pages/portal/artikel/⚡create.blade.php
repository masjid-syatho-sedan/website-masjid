<?php

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Tulis Artikel Baru')] #[Layout('layouts.portal')] class extends Component {
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $judul = '';

    public string $slug = '';

    #[Validate('nullable|string|max:500')]
    public string $ringkasan = '';

    #[Validate('required|string|min:50')]
    public string $konten = '';

    #[Validate('nullable|exists:kategoris,id')]
    public string $kategoriId = '';

    #[Validate('nullable|array')]
    public array $tagDipilih = [];

    #[Validate('nullable|image|max:2048')]
    public mixed $gambar = null;

    #[Validate('required|in:draft,diterbitkan,diarsipkan')]
    public string $status = 'draft';

    public bool $unggulan = false;

    #[Validate('nullable|date')]
    public string $diterbitkanPada = '';

    public string $tagBaru = '';

    public function updatedJudul(): void
    {
        if (empty($this->slug)) {
            $this->slug = Str::slug($this->judul);
        }
    }

    public function tambahTagBaru(): void
    {
        $nama = trim($this->tagBaru);
        if (! $nama) {
            return;
        }

        $tag = Tag::firstOrCreate(
            ['slug' => Str::slug($nama)],
            ['nama' => $nama]
        );

        if (! in_array($tag->id, $this->tagDipilih)) {
            $this->tagDipilih[] = $tag->id;
        }

        $this->tagBaru = '';
    }

    public function simpan(): void
    {
        $validated = $this->validate([
            'judul'           => 'required|string|max:255',
            'ringkasan'       => 'nullable|string|max:500',
            'konten'          => 'required|string|min:10',
            'kategoriId'      => 'nullable|exists:kategoris,id',
            'tagDipilih'      => 'nullable|array',
            'tagDipilih.*'    => 'exists:tags,id',
            'status'          => 'required|in:draft,diterbitkan,diarsipkan',
            'unggulan'        => 'boolean',
            'diterbitkanPada' => 'nullable|date',
        ]);

        // Pastikan slug unik
        $slug = Str::slug($this->judul);
        $slugBase = $slug;
        $counter = 1;
        while (Artikel::where('slug', $slug)->exists()) {
            $slug = $slugBase.'-'.$counter++;
        }

        $gambarPath = null;
        if ($this->gambar) {
            $gambarPath = $this->gambar->store('artikel', 'public');
        }

        $artikel = Artikel::create([
            'user_id'          => Auth::id(),
            'kategori_id'      => $this->kategoriId ?: null,
            'judul'            => $this->judul,
            'slug'             => $slug,
            'ringkasan'        => $this->ringkasan,
            'konten'           => $this->konten,
            'gambar'           => $gambarPath,
            'status'           => $this->status,
            'unggulan'         => $this->unggulan,
            'diterbitkan_pada' => $this->status === 'diterbitkan'
                ? ($this->diterbitkanPada ?: now())
                : ($this->diterbitkanPada ?: null),
        ]);

        if (! empty($this->tagDipilih)) {
            $artikel->tags()->sync($this->tagDipilih);
        }

        $this->redirect(route('portal.artikel.index'), navigate: true);
    }

    #[Computed]
    public function kategoris(): mixed
    {
        return Kategori::orderBy('nama')->get();
    }

    #[Computed]
    public function tags(): mixed
    {
        return Tag::orderBy('nama')->get();
    }
}; ?>

<div class="p-6 max-w-5xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('portal.artikel.index') }}" wire:navigate
           class="p-2 rounded-xl border border-amber-200 hover:bg-amber-50 transition text-amber-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-amber-900">Tulis Artikel Baru</h1>
            <p class="text-sm text-amber-600 mt-0.5">Isi form di bawah untuk menerbitkan artikel</p>
        </div>
    </div>

    <form wire:submit="simpan" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Kolom kiri: konten --}}
        <div class="lg:col-span-2 space-y-5">
            {{-- Judul --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5">
                <label class="block text-sm font-semibold text-amber-800 mb-1.5">Judul Artikel <span class="text-red-500">*</span></label>
                <input wire:model.blur="judul" type="text" placeholder="Masukkan judul yang menarik..."
                    class="w-full px-4 py-3 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-300 focus:outline-none text-amber-900 text-lg font-semibold">
                @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                <div class="mt-3">
                    <label class="block text-xs font-semibold text-amber-600 mb-1">Slug URL</label>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-amber-400">/artikel/</span>
                        <input wire:model="slug" type="text" placeholder="judul-artikel"
                            class="flex-1 px-3 py-1.5 rounded-lg border border-amber-200 focus:border-amber-500 focus:outline-none text-xs text-amber-700 bg-amber-50">
                    </div>
                </div>
            </div>

            {{-- Ringkasan --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5">
                <label class="block text-sm font-semibold text-amber-800 mb-1.5">Ringkasan / Excerpt</label>
                <textarea wire:model="ringkasan" rows="3"
                    placeholder="Tulis ringkasan singkat artikel (opsional)..."
                    class="w-full px-4 py-3 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-300 focus:outline-none text-amber-900 resize-none"></textarea>
                @error('ringkasan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                <p class="text-xs text-amber-400 mt-1 text-right">{{ strlen($ringkasan) }}/500 karakter</p>
            </div>

            {{-- Konten --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5">
                <label class="block text-sm font-semibold text-amber-800 mb-1.5">Konten Artikel <span class="text-red-500">*</span></label>
                <textarea wire:model="konten" rows="18"
                    placeholder="Tulis konten artikel di sini..."
                    class="w-full px-4 py-3 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-300 focus:outline-none text-amber-900 resize-y font-mono text-sm leading-relaxed"></textarea>
                @error('konten') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Gambar sampul --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5">
                <label class="block text-sm font-semibold text-amber-800 mb-3">Gambar Sampul</label>
                @if ($gambar)
                    <div class="mb-3 relative">
                        <img src="{{ $gambar->temporaryUrl() }}" alt="Preview gambar" class="w-full h-48 object-cover rounded-xl">
                        <button type="button" wire:click="$set('gambar', null)"
                            class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @else
                    <label class="flex flex-col items-center justify-center h-36 border-2 border-dashed border-amber-300 rounded-xl cursor-pointer hover:bg-amber-50 transition">
                        <svg class="w-10 h-10 text-amber-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-sm text-amber-600 font-medium">Klik untuk unggah gambar</span>
                        <span class="text-xs text-amber-400 mt-1">PNG, JPG, max 2MB</span>
                        <input wire:model="gambar" type="file" accept="image/*" class="hidden">
                    </label>
                @endif
                @error('gambar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Kolom kanan: meta --}}
        <div class="space-y-5">
            {{-- Tombol simpan --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5 space-y-3">
                <button type="submit"
                    class="w-full py-3 bg-amber-700 hover:bg-amber-800 text-white font-bold rounded-xl transition shadow-md text-sm">
                    <span wire:loading.remove wire:target="simpan">
                        {{ $status === 'diterbitkan' ? '🚀 Terbitkan Artikel' : '💾 Simpan' }}
                    </span>
                    <span wire:loading wire:target="simpan">Menyimpan...</span>
                </button>
                <a href="{{ route('portal.artikel.index') }}" wire:navigate
                   class="block w-full py-2.5 text-center border border-amber-300 text-amber-700 hover:bg-amber-50 font-semibold rounded-xl transition text-sm">
                    Batal
                </a>
            </div>

            {{-- Status --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5">
                <h3 class="text-sm font-bold text-amber-800 mb-3">Status Penerbitan</h3>
                <div class="space-y-2">
                    @foreach (['draft' => ['label' => 'Draft', 'desc' => 'Tersimpan, tidak tampil publik', 'warna' => 'yellow'], 'diterbitkan' => ['label' => 'Diterbitkan', 'desc' => 'Tampil di halaman publik', 'warna' => 'green'], 'diarsipkan' => ['label' => 'Diarsipkan', 'desc' => 'Disembunyikan dari publik', 'warna' => 'gray']] as $val => $info)
                        <label class="flex items-center gap-3 p-2.5 rounded-lg cursor-pointer border transition {{ $status === $val ? 'border-amber-400 bg-amber-50' : 'border-transparent hover:bg-amber-50/50' }}">
                            <input wire:model="status" type="radio" value="{{ $val }}" class="text-amber-600">
                            <div>
                                <p class="text-sm font-semibold text-amber-900">{{ $info['label'] }}</p>
                                <p class="text-xs text-amber-500">{{ $info['desc'] }}</p>
                            </div>
                        </label>
                    @endforeach
                </div>

                @if ($status === 'diterbitkan')
                    <div class="mt-3">
                        <label class="block text-xs font-semibold text-amber-700 mb-1">Tanggal Terbit</label>
                        <input wire:model="diterbitkanPada" type="datetime-local"
                            class="w-full px-3 py-2 rounded-lg border border-amber-200 focus:border-amber-500 focus:outline-none text-sm text-amber-900">
                    </div>
                @endif
            </div>

            {{-- Kategori --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5">
                <h3 class="text-sm font-bold text-amber-800 mb-3">Kategori</h3>
                <select wire:model="kategoriId"
                    class="w-full px-3 py-2.5 rounded-xl border border-amber-200 focus:border-amber-500 focus:outline-none text-sm text-amber-900 bg-white">
                    <option value="">— Tanpa Kategori —</option>
                    @foreach ($this->kategoris as $kat)
                        <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Tags --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5">
                <h3 class="text-sm font-bold text-amber-800 mb-3">Tag</h3>

                {{-- Tag yang dipilih --}}
                @if (!empty($tagDipilih))
                    <div class="flex flex-wrap gap-1.5 mb-3">
                        @foreach ($this->tags->whereIn('id', $tagDipilih) as $tag)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full">
                                #{{ $tag->nama }}
                                <button type="button" wire:click="$set('tagDipilih', array_values(array_filter($tagDipilih, fn($id) => $id != {{ $tag->id }})))">
                                    <svg class="w-3 h-3 hover:text-red-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </span>
                        @endforeach
                    </div>
                @endif

                {{-- Tambah tag baru --}}
                <div class="flex gap-2 mb-3">
                    <input wire:model="tagBaru" wire:keydown.enter.prevent="tambahTagBaru" type="text"
                        placeholder="Tag baru..."
                        class="flex-1 px-3 py-2 rounded-lg border border-amber-200 focus:border-amber-500 focus:outline-none text-xs text-amber-900">
                    <button type="button" wire:click="tambahTagBaru"
                        class="px-3 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg text-xs font-semibold transition">
                        +
                    </button>
                </div>

                {{-- Pilih dari yang ada --}}
                <div class="flex flex-wrap gap-1.5 max-h-36 overflow-y-auto">
                    @foreach ($this->tags as $tag)
                        <button type="button"
                            wire:click="{{ in_array($tag->id, $tagDipilih) ? '$set(\'tagDipilih\', array_values(array_filter($tagDipilih, fn($id) => $id != '.$tag->id.')))' : '$set(\'tagDipilih\', [...$tagDipilih, '.$tag->id.'])' }}"
                            class="px-2.5 py-1 text-xs rounded-full border transition {{ in_array($tag->id, $tagDipilih) ? 'bg-amber-600 text-white border-amber-600' : 'border-amber-300 text-amber-600 hover:bg-amber-50' }}">
                            #{{ $tag->nama }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Unggulan --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5">
                <label class="flex items-center justify-between cursor-pointer">
                    <div>
                        <p class="text-sm font-bold text-amber-800">Artikel Unggulan</p>
                        <p class="text-xs text-amber-500 mt-0.5">Tampilkan di bagian unggulan homepage</p>
                    </div>
                    <div class="relative">
                        <input wire:model="unggulan" type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-amber-200 rounded-full peer peer-checked:bg-amber-600 transition"></div>
                        <div class="absolute top-0.5 left-0.5 bg-white w-5 h-5 rounded-full shadow transition peer-checked:translate-x-5"></div>
                    </div>
                </label>
            </div>
        </div>
    </form>
</div>
