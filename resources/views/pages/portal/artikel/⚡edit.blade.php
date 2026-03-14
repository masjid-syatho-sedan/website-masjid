<?php

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Edit Artikel')] #[Layout('layouts.portal')] class extends Component {
    use WithFileUploads;

    public Artikel $artikel;

    public string $judul = '';
    public string $slug = '';
    public string $ringkasan = '';
    public string $konten = '';
    public string $kategoriId = '';
    public array $tagDipilih = [];
    public mixed $gambarBaru = null;
    public string $status = 'draft';
    public bool $unggulan = false;
    public string $diterbitkanPada = '';
    public string $tagBaru = '';
    public bool $hapusGambar = false;

    public function mount(int $id): void
    {
        $this->artikel = Artikel::with(['tags'])->findOrFail($id);

        $this->judul = $this->artikel->judul;
        $this->slug = $this->artikel->slug;
        $this->ringkasan = $this->artikel->ringkasan ?? '';
        $this->konten = $this->artikel->konten;
        $this->kategoriId = $this->artikel->kategori_id ? (string) $this->artikel->kategori_id : '';
        $this->tagDipilih = $this->artikel->tags->pluck('id')->toArray();
        $this->status = $this->artikel->status;
        $this->unggulan = $this->artikel->unggulan;
        $this->diterbitkanPada = $this->artikel->diterbitkan_pada
            ? $this->artikel->diterbitkan_pada->format('Y-m-d\TH:i')
            : '';
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
        $this->validate([
            'judul'           => 'required|string|max:255',
            'slug'            => 'required|string|max:255|unique:artikels,slug,'.$this->artikel->id,
            'ringkasan'       => 'nullable|string|max:500',
            'konten'          => 'required|string|min:10',
            'kategoriId'      => 'nullable|exists:kategoris,id',
            'tagDipilih'      => 'nullable|array',
            'tagDipilih.*'    => 'exists:tags,id',
            'gambarBaru'      => 'nullable|image|max:2048',
            'status'          => 'required|in:draft,diterbitkan,diarsipkan',
            'unggulan'        => 'boolean',
            'diterbitkanPada' => 'nullable|date',
        ]);

        $gambarPath = $this->artikel->gambar;

        if ($this->hapusGambar) {
            if ($gambarPath) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = null;
        }

        if ($this->gambarBaru) {
            if ($gambarPath) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = $this->gambarBaru->store('artikel', 'public');
        }

        $this->artikel->update([
            'kategori_id'      => $this->kategoriId ?: null,
            'judul'            => $this->judul,
            'slug'             => $this->slug,
            'ringkasan'        => $this->ringkasan,
            'konten'           => $this->konten,
            'gambar'           => $gambarPath,
            'status'           => $this->status,
            'unggulan'         => $this->unggulan,
            'diterbitkan_pada' => $this->status === 'diterbitkan'
                ? ($this->diterbitkanPada ?: ($this->artikel->diterbitkan_pada ?? now()))
                : ($this->diterbitkanPada ?: $this->artikel->diterbitkan_pada),
        ]);

        $this->artikel->tags()->sync($this->tagDipilih);

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
            <h1 class="text-2xl font-bold text-amber-900">Edit Artikel</h1>
            <p class="text-sm text-amber-500 mt-0.5 truncate max-w-xs">{{ $artikel->judul }}</p>
        </div>
        @if ($artikel->status === 'diterbitkan')
            <a href="{{ route('artikel.show', $artikel->slug) }}" target="_blank"
               class="ml-auto flex items-center gap-1.5 text-xs text-amber-600 hover:text-amber-900 border border-amber-300 hover:border-amber-500 px-3 py-1.5 rounded-lg transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Lihat di Publik
            </a>
        @endif
    </div>

    <form wire:submit="simpan" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Kolom kiri: konten --}}
        <div class="lg:col-span-2 space-y-5">
            {{-- Judul --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5">
                <label class="block text-sm font-semibold text-amber-800 mb-1.5">Judul Artikel <span class="text-red-500">*</span></label>
                <input wire:model="judul" type="text"
                    class="w-full px-4 py-3 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-300 focus:outline-none text-amber-900 text-lg font-semibold">
                @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                <div class="mt-3">
                    <label class="block text-xs font-semibold text-amber-600 mb-1">Slug URL</label>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-amber-400">/artikel/</span>
                        <input wire:model="slug" type="text"
                            class="flex-1 px-3 py-1.5 rounded-lg border border-amber-200 focus:border-amber-500 focus:outline-none text-xs text-amber-700 bg-amber-50">
                    </div>
                    @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Ringkasan --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5">
                <label class="block text-sm font-semibold text-amber-800 mb-1.5">Ringkasan / Excerpt</label>
                <textarea wire:model="ringkasan" rows="3"
                    class="w-full px-4 py-3 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-300 focus:outline-none text-amber-900 resize-none"></textarea>
                @error('ringkasan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                <p class="text-xs text-amber-400 mt-1 text-right">{{ strlen($ringkasan) }}/500 karakter</p>
            </div>

            {{-- Konten --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5">
                <label class="block text-sm font-semibold text-amber-800 mb-1.5">Konten Artikel <span class="text-red-500">*</span></label>
                <textarea wire:model="konten" rows="18"
                    class="w-full px-4 py-3 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-300 focus:outline-none text-amber-900 resize-y font-mono text-sm leading-relaxed"></textarea>
                @error('konten') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Gambar sampul --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5">
                <label class="block text-sm font-semibold text-amber-800 mb-3">Gambar Sampul</label>
                @if ($gambarBaru)
                    <div class="mb-3 relative">
                        <img src="{{ $gambarBaru->temporaryUrl() }}" alt="Preview baru" class="w-full h-48 object-cover rounded-xl">
                        <button type="button" wire:click="$set('gambarBaru', null)"
                            class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @elseif ($artikel->gambar && !$hapusGambar)
                    <div class="mb-3 relative">
                        <img src="{{ asset('storage/'.$artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-48 object-cover rounded-xl">
                        <div class="absolute top-2 right-2 flex gap-2">
                            <button type="button" wire:click="$set('hapusGambar', true)"
                                class="p-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition text-xs px-3">
                                Hapus Gambar
                            </button>
                        </div>
                    </div>
                @else
                    <label class="flex flex-col items-center justify-center h-36 border-2 border-dashed border-amber-300 rounded-xl cursor-pointer hover:bg-amber-50 transition">
                        <svg class="w-10 h-10 text-amber-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-sm text-amber-600 font-medium">Klik untuk unggah gambar baru</span>
                        <span class="text-xs text-amber-400 mt-1">PNG, JPG, max 2MB</span>
                        <input wire:model="gambarBaru" type="file" accept="image/*" class="hidden">
                    </label>
                    @if ($hapusGambar)
                        <button type="button" wire:click="$set('hapusGambar', false)" class="mt-2 text-xs text-amber-600 hover:text-amber-900">
                            ↩ Batalkan hapus gambar
                        </button>
                    @endif
                @endif
                @error('gambarBaru') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Kolom kanan: meta --}}
        <div class="space-y-5">
            {{-- Tombol simpan --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5 space-y-3">
                <button type="submit"
                    class="w-full py-3 bg-amber-700 hover:bg-amber-800 text-white font-bold rounded-xl transition shadow-md text-sm">
                    <span wire:loading.remove wire:target="simpan">💾 Perbarui Artikel</span>
                    <span wire:loading wire:target="simpan">Menyimpan...</span>
                </button>
                <a href="{{ route('portal.artikel.index') }}" wire:navigate
                   class="block w-full py-2.5 text-center border border-amber-300 text-amber-700 hover:bg-amber-50 font-semibold rounded-xl transition text-sm">
                    Batal
                </a>
                <p class="text-xs text-amber-400 text-center">
                    Dibuat {{ $artikel->created_at->translatedFormat('d M Y') }} ·
                    Diperbarui {{ $artikel->updated_at->diffForHumans() }}
                </p>
            </div>

            {{-- Status --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5">
                <h3 class="text-sm font-bold text-amber-800 mb-3">Status Penerbitan</h3>
                <div class="space-y-2">
                    @foreach (['draft' => ['label' => 'Draft', 'desc' => 'Tersimpan, tidak tampil publik'], 'diterbitkan' => ['label' => 'Diterbitkan', 'desc' => 'Tampil di halaman publik'], 'diarsipkan' => ['label' => 'Diarsipkan', 'desc' => 'Disembunyikan dari publik']] as $val => $info)
                        <label class="flex items-center gap-3 p-2.5 rounded-lg cursor-pointer border transition {{ $status === $val ? 'border-amber-400 bg-amber-50' : 'border-transparent hover:bg-amber-50/50' }}">
                            <input wire:model="status" type="radio" value="{{ $val }}" class="text-amber-600">
                            <div>
                                <p class="text-sm font-semibold text-amber-900">{{ $info['label'] }}</p>
                                <p class="text-xs text-amber-500">{{ $info['desc'] }}</p>
                            </div>
                        </label>
                    @endforeach
                </div>

                <div class="mt-3">
                    <label class="block text-xs font-semibold text-amber-700 mb-1">Tanggal Terbit</label>
                    <input wire:model="diterbitkanPada" type="datetime-local"
                        class="w-full px-3 py-2 rounded-lg border border-amber-200 focus:border-amber-500 focus:outline-none text-sm text-amber-900">
                </div>
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

                <div class="flex gap-2 mb-3">
                    <input wire:model="tagBaru" wire:keydown.enter.prevent="tambahTagBaru" type="text"
                        placeholder="Tag baru..."
                        class="flex-1 px-3 py-2 rounded-lg border border-amber-200 focus:border-amber-500 focus:outline-none text-xs text-amber-900">
                    <button type="button" wire:click="tambahTagBaru"
                        class="px-3 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg text-xs font-semibold transition">
                        +
                    </button>
                </div>

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
                        <p class="text-xs text-amber-500 mt-0.5">Tampilkan di bagian unggulan</p>
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
