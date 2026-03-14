<?php

use App\Models\Artikel;
use App\Models\Kategori;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Kelola Artikel')] #[Layout('layouts.portal')] class extends Component {
    use WithPagination;

    #[Url(except: '')]
    public string $cari = '';

    #[Url(except: '')]
    public string $status = '';

    #[Url(except: '')]
    public string $kategori = '';

    #[Url(except: 'created_at')]
    public string $urutan = 'created_at';

    #[Url(except: 'desc')]
    public string $arah = 'desc';

    public array $dipilih = [];
    public bool $konfirmasiHapus = false;
    public ?int $hapusId = null;
    public bool $hapusMassal = false;

    public function updatedCari(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function updatedKategori(): void
    {
        $this->resetPage();
    }

    public function urut(string $kolom): void
    {
        if ($this->urutan === $kolom) {
            $this->arah = $this->arah === 'asc' ? 'desc' : 'asc';
        } else {
            $this->urutan = $kolom;
            $this->arah = 'desc';
        }
    }

    public function konfirmasiHapusSatu(int $id): void
    {
        $this->hapusId = $id;
        $this->hapusMassal = false;
        $this->konfirmasiHapus = true;
    }

    public function konfirmasiHapusMassal(): void
    {
        if (empty($this->dipilih)) {
            return;
        }

        $this->hapusMassal = true;
        $this->konfirmasiHapus = true;
    }

    public function hapus(): void
    {
        if ($this->hapusMassal) {
            Artikel::query()->whereIn('id', $this->dipilih)->delete();
            $this->dipilih = [];
        } elseif ($this->hapusId) {
            Artikel::query()->find($this->hapusId)?->delete();
        }

        $this->konfirmasiHapus = false;
        $this->hapusId = null;
        $this->hapusMassal = false;

        $this->dispatch('notify', ['message' => 'Artikel berhasil dihapus.', 'type' => 'success']);
    }

    public function batalHapus(): void
    {
        $this->konfirmasiHapus = false;
        $this->hapusId = null;
        $this->hapusMassal = false;
    }

    public function toggleUnggulan(int $id): void
    {
        $artikel = Artikel::query()->find($id);
        if ($artikel) {
            $artikel->update(['unggulan' => ! $artikel->unggulan]);
        }
    }

    public function ubahStatus(int $id, string $statusBaru): void
    {
        $artikel = Artikel::query()->find($id);
        if (! $artikel) {
            return;
        }

        $artikel->status = $statusBaru;
        if ($statusBaru === 'diterbitkan' && ! $artikel->diterbitkan_pada) {
            $artikel->diterbitkan_pada = now();
        }
        $artikel->save();

        $this->dispatch('notify', ['message' => 'Status artikel diperbarui.', 'type' => 'success']);
    }

    #[Computed]
    public function artikels(): mixed
    {
        $kolomUrutan = in_array($this->urutan, ['judul', 'status', 'dilihat', 'created_at', 'diterbitkan_pada'])
            ? $this->urutan
            : 'created_at';

        return Artikel::query()
            ->with(['kategori', 'user', 'tags'])
            ->when($this->cari, fn ($q) => $q->where(function ($q) {
                $q->where('judul', 'like', '%'.$this->cari.'%')
                    ->orWhere('ringkasan', 'like', '%'.$this->cari.'%');
            }))
            ->when($this->status, fn ($q) => $q->where('status', $this->status))
            ->when($this->kategori, fn ($q) => $q->where('kategori_id', $this->kategori))
            ->orderBy($kolomUrutan, $this->arah)
            ->paginate(15);
    }

    #[Computed]
    public function kategoris(): mixed
    {
        return Kategori::orderBy('nama')->get();
    }

    #[Computed]
    public function statistik(): array
    {
        return [
            'total'       => Artikel::count(),
            'diterbitkan' => Artikel::where('status', 'diterbitkan')->count(),
            'draft'       => Artikel::where('status', 'draft')->count(),
            'diarsipkan'  => Artikel::where('status', 'diarsipkan')->count(),
        ];
    }
}; ?>

<div class="p-6 max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6 flex-wrap gap-4">
        <div>
            <h1 class="text-2xl font-bold text-amber-900">Kelola Artikel</h1>
            <p class="text-amber-600 text-sm mt-1">Buat, edit, dan kelola semua artikel blog masjid</p>
        </div>
        <a href="{{ route('portal.artikel.create') }}" wire:navigate
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-700 hover:bg-amber-800 text-white font-semibold rounded-xl transition shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tulis Artikel Baru
        </a>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        @foreach ([
            ['label' => 'Total Artikel', 'nilai' => $this->statistik['total'], 'warna' => 'amber', 'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
            ['label' => 'Diterbitkan', 'nilai' => $this->statistik['diterbitkan'], 'warna' => 'green', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label' => 'Draft', 'nilai' => $this->statistik['draft'], 'warna' => 'yellow', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
            ['label' => 'Diarsipkan', 'nilai' => $this->statistik['diarsipkan'], 'warna' => 'gray', 'icon' => 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'],
        ] as $stat)
            <div class="bg-white rounded-xl border border-amber-100 shadow-sm p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-amber-600 uppercase tracking-wide">{{ $stat['label'] }}</p>
                        <p class="text-2xl font-bold text-amber-900 mt-1">{{ $stat['nilai'] }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
                        </svg>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Filter & Search --}}
    <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-4 mb-4">
        <div class="flex flex-col md:flex-row gap-3">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input wire:model.live.debounce.400ms="cari" type="text" placeholder="Cari judul atau ringkasan..."
                    class="w-full pl-9 pr-4 py-2.5 rounded-lg border border-amber-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-300 focus:outline-none text-sm text-amber-900">
            </div>
            <select wire:model.live="status" class="px-4 py-2.5 rounded-lg border border-amber-200 focus:border-amber-500 focus:outline-none text-sm text-amber-900 bg-white">
                <option value="">Semua Status</option>
                <option value="diterbitkan">Diterbitkan</option>
                <option value="draft">Draft</option>
                <option value="diarsipkan">Diarsipkan</option>
            </select>
            <select wire:model.live="kategori" class="px-4 py-2.5 rounded-lg border border-amber-200 focus:border-amber-500 focus:outline-none text-sm text-amber-900 bg-white">
                <option value="">Semua Kategori</option>
                @foreach ($this->kategoris as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                @endforeach
            </select>
            @if ($cari || $status || $kategori)
                <button wire:click="$set('cari', ''); $set('status', ''); $set('kategori', '')"
                    class="px-4 py-2.5 text-sm text-amber-700 hover:text-amber-900 border border-amber-300 hover:border-amber-500 rounded-lg transition">
                    Reset
                </button>
            @endif
        </div>
    </div>

    {{-- Aksi massal --}}
    @if (!empty($dipilih))
        <div class="flex items-center gap-3 bg-amber-50 border border-amber-300 rounded-xl px-4 py-3 mb-4">
            <span class="text-sm font-semibold text-amber-800">{{ count($dipilih) }} artikel dipilih</span>
            <button wire:click="konfirmasiHapusMassal"
                class="px-3 py-1.5 text-xs bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition">
                Hapus Dipilih
            </button>
            <button wire:click="$set('dipilih', [])" class="text-xs text-amber-600 hover:text-amber-800 ml-auto">Batal</button>
        </div>
    @endif

    {{-- Tabel --}}
    <div class="bg-white rounded-2xl border border-amber-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-amber-50 border-b border-amber-100">
                    <tr>
                        <th class="px-4 py-3 text-left w-8">
                            <input type="checkbox" wire:model="dipilih"
                                @if ($this->artikels->isEmpty()) disabled @endif
                                class="rounded border-amber-300">
                        </th>
                        <th class="px-4 py-3 text-left">
                            <button wire:click="urut('judul')" class="flex items-center gap-1 font-semibold text-amber-800 hover:text-amber-900">
                                Judul
                                @if ($urutan === 'judul')
                                    <svg class="w-3 h-3 {{ $arah === 'asc' ? 'rotate-180' : '' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                                @endif
                            </button>
                        </th>
                        <th class="px-4 py-3 text-left font-semibold text-amber-800">Kategori</th>
                        <th class="px-4 py-3 text-left">
                            <button wire:click="urut('status')" class="flex items-center gap-1 font-semibold text-amber-800 hover:text-amber-900">
                                Status
                                @if ($urutan === 'status')
                                    <svg class="w-3 h-3 {{ $arah === 'asc' ? 'rotate-180' : '' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                                @endif
                            </button>
                        </th>
                        <th class="px-4 py-3 text-left">
                            <button wire:click="urut('dilihat')" class="flex items-center gap-1 font-semibold text-amber-800 hover:text-amber-900">
                                Dilihat
                                @if ($urutan === 'dilihat')
                                    <svg class="w-3 h-3 {{ $arah === 'asc' ? 'rotate-180' : '' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                                @endif
                            </button>
                        </th>
                        <th class="px-4 py-3 text-left">
                            <button wire:click="urut('created_at')" class="flex items-center gap-1 font-semibold text-amber-800 hover:text-amber-900">
                                Tanggal
                                @if ($urutan === 'created_at')
                                    <svg class="w-3 h-3 {{ $arah === 'asc' ? 'rotate-180' : '' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                                @endif
                            </button>
                        </th>
                        <th class="px-4 py-3 text-right font-semibold text-amber-800">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-amber-50">
                    @forelse ($this->artikels as $art)
                        <tr class="hover:bg-amber-50/50 transition" wire:key="artikel-{{ $art->id }}">
                            <td class="px-4 py-3">
                                <input type="checkbox" wire:model="dipilih" value="{{ $art->id }}"
                                    class="rounded border-amber-300 text-amber-600">
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-start gap-3 max-w-sm">
                                    @if ($art->gambar)
                                        <img src="{{ asset('storage/'.$art->gambar) }}" alt="{{ $art->judul }}" class="w-12 h-10 rounded-lg object-cover flex-shrink-0">
                                    @else
                                        <div class="w-12 h-10 rounded-lg bg-gradient-to-br from-amber-400 to-amber-600 flex-shrink-0 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white/60" fill="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-amber-900 line-clamp-2 leading-snug">{{ $art->judul }}</p>
                                        <p class="text-xs text-amber-500 mt-0.5">{{ $art->user->name }}</p>
                                        @if ($art->unggulan)
                                            <span class="inline-block mt-1 px-2 py-0.5 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">★ Unggulan</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                @if ($art->kategori)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full text-white" style="background-color: {{ $art->kategori->warna }}">
                                        {{ $art->kategori->nama }}
                                    </span>
                                @else
                                    <span class="text-amber-400 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <select wire:change="ubahStatus({{ $art->id }}, $event.target.value)"
                                    class="text-xs py-1.5 px-2 rounded-lg border font-semibold focus:outline-none focus:ring-1 focus:ring-amber-300 transition
                                    {{ $art->status === 'diterbitkan' ? 'border-green-300 bg-green-50 text-green-700' : ($art->status === 'draft' ? 'border-yellow-300 bg-yellow-50 text-yellow-700' : 'border-gray-300 bg-gray-50 text-gray-600') }}">
                                    <option value="diterbitkan" {{ $art->status === 'diterbitkan' ? 'selected' : '' }}>Diterbitkan</option>
                                    <option value="draft" {{ $art->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="diarsipkan" {{ $art->status === 'diarsipkan' ? 'selected' : '' }}>Diarsipkan</option>
                                </select>
                            </td>
                            <td class="px-4 py-3 text-amber-700 font-semibold">{{ number_format($art->dilihat) }}</td>
                            <td class="px-4 py-3 text-amber-600 text-xs">
                                <span>{{ $art->created_at->translatedFormat('d M Y') }}</span>
                                @if ($art->diterbitkan_pada)
                                    <br><span class="text-green-600">↑ {{ $art->diterbitkan_pada->translatedFormat('d M Y') }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    {{-- Toggle unggulan --}}
                                    <button wire:click="toggleUnggulan({{ $art->id }})"
                                        title="{{ $art->unggulan ? 'Hapus dari unggulan' : 'Jadikan unggulan' }}"
                                        class="p-1.5 rounded-lg transition {{ $art->unggulan ? 'text-yellow-500 hover:bg-yellow-50' : 'text-amber-300 hover:bg-amber-50 hover:text-yellow-500' }}">
                                        <svg class="w-4 h-4" fill="{{ $art->unggulan ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                        </svg>
                                    </button>
                                    {{-- Lihat --}}
                                    @if ($art->status === 'diterbitkan')
                                        <a href="{{ route('artikel.show', $art->slug) }}" target="_blank"
                                            class="p-1.5 rounded-lg text-amber-400 hover:bg-amber-50 hover:text-amber-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    @endif
                                    {{-- Edit --}}
                                    <a href="{{ route('portal.artikel.edit', $art->id) }}" wire:navigate
                                        class="p-1.5 rounded-lg text-amber-400 hover:bg-amber-50 hover:text-amber-700 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    {{-- Hapus --}}
                                    <button wire:click="konfirmasiHapusSatu({{ $art->id }})"
                                        class="p-1.5 rounded-lg text-red-300 hover:bg-red-50 hover:text-red-600 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-16 text-center">
                                <svg class="w-12 h-12 mx-auto text-amber-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <p class="font-semibold text-amber-800">Belum ada artikel</p>
                                <p class="text-sm text-amber-500 mt-1">Mulai tulis artikel pertama Anda</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($this->artikels->hasPages())
            <div class="px-4 py-4 border-t border-amber-100">
                {{ $this->artikels->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>

    {{-- Modal konfirmasi hapus --}}
    @if ($konfirmasiHapus)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-2xl shadow-2xl p-6 max-w-sm w-full mx-4">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Konfirmasi Hapus</h3>
                        <p class="text-sm text-gray-500">
                            @if ($hapusMassal)
                                Hapus {{ count($dipilih) }} artikel yang dipilih?
                            @else
                                Hapus artikel ini secara permanen?
                            @endif
                        </p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button wire:click="batalHapus" class="flex-1 px-4 py-2 border border-gray-300 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button wire:click="hapus" class="flex-1 px-4 py-2 bg-red-500 hover:bg-red-600 rounded-xl text-sm font-semibold text-white transition">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
