<?php

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Tag;
use App\Models\User;
use Livewire\Livewire;

// ===================== PUBLIC HALAMAN ARTIKEL =====================

test('halaman /artikel bisa diakses oleh publik', function () {
    $this->get(route('blog'))->assertOk();
});

test('halaman /artikel menampilkan artikel yang diterbitkan', function () {
    $artikel = Artikel::factory()->diterbitkan()->create();

    $this->get(route('blog'))->assertSee($artikel->judul);
});

test('halaman /artikel tidak menampilkan artikel draft', function () {
    $artikel = Artikel::factory()->draft()->create(['judul' => 'Artikel Tersembunyi Draft']);

    $this->get(route('blog'))->assertDontSee('Artikel Tersembunyi Draft');
});

test('komponen public artikel index bisa melakukan pencarian', function () {
    $artikel = Artikel::factory()->diterbitkan()->create(['judul' => 'Artikel Khusus Unik XYZ']);
    Artikel::factory()->diterbitkan()->create(['judul' => 'Artikel Biasa ABC']);

    Livewire::test('pages::artikel.index')
        ->set('cari', 'Khusus Unik XYZ')
        ->assertSee('Artikel Khusus Unik XYZ')
        ->assertDontSee('Artikel Biasa ABC');
});

// ===================== HALAMAN DETAIL ARTIKEL =====================

test('halaman detail artikel yang diterbitkan bisa diakses', function () {
    $artikel = Artikel::factory()->diterbitkan()->create();

    $this->get(route('artikel.show', $artikel->slug))
        ->assertOk()
        ->assertSee($artikel->judul);
});

test('halaman detail artikel draft tidak bisa diakses publik', function () {
    $artikel = Artikel::factory()->draft()->create();

    $this->get(route('artikel.show', $artikel->slug))->assertNotFound();
});

test('view count bertambah ketika artikel dilihat', function () {
    $artikel = Artikel::factory()->diterbitkan()->create(['dilihat' => 0]);

    $this->get(route('artikel.show', $artikel->slug));

    expect($artikel->fresh()->dilihat)->toBe(1);
});

// ===================== PORTAL KELOLA ARTIKEL =====================

test('halaman portal artikel tidak bisa diakses oleh tamu', function () {
    $this->get(route('portal.artikel.index'))->assertRedirect(route('login'));
});

test('halaman portal artikel bisa diakses oleh pengguna terautentikasi', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('portal.artikel.index'))
        ->assertOk();
});

test('portal artikel menampilkan semua artikel termasuk draft', function () {
    $user = User::factory()->create();
    $published = Artikel::factory()->diterbitkan()->create(['user_id' => $user->id]);
    $draft = Artikel::factory()->draft()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test('pages::portal.artikel.index')
        ->assertSee($published->judul)
        ->assertSee($draft->judul);
});

test('pengguna bisa mengubah status artikel melalui portal', function () {
    $user = User::factory()->create();
    $artikel = Artikel::factory()->draft()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test('pages::portal.artikel.index')
        ->call('ubahStatus', $artikel->id, 'diterbitkan');

    expect($artikel->fresh()->status)->toBe('diterbitkan');
});

test('pengguna bisa toggle unggulan artikel', function () {
    $user = User::factory()->create();
    $artikel = Artikel::factory()->create(['user_id' => $user->id, 'unggulan' => false]);

    Livewire::actingAs($user)
        ->test('pages::portal.artikel.index')
        ->call('toggleUnggulan', $artikel->id);

    expect($artikel->fresh()->unggulan)->toBeTrue();
});

test('pengguna bisa menghapus artikel melalui portal', function () {
    $user = User::factory()->create();
    $artikel = Artikel::factory()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test('pages::portal.artikel.index')
        ->call('konfirmasiHapusSatu', $artikel->id)
        ->call('hapus');

    $this->assertDatabaseMissing('artikels', ['id' => $artikel->id]);
});

// ===================== PORTAL BUAT ARTIKEL =====================

test('halaman buat artikel bisa diakses', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('portal.artikel.create'))
        ->assertOk();
});

test('pengguna bisa membuat artikel baru', function () {
    $user = User::factory()->create();
    $kategori = Kategori::factory()->create();
    $tag = Tag::factory()->create();

    Livewire::actingAs($user)
        ->test('pages::portal.artikel.create')
        ->set('judul', 'Artikel Test Baru')
        ->set('konten', 'Ini adalah konten artikel test yang cukup panjang untuk divalidasi sistem kami.')
        ->set('ringkasan', 'Ringkasan singkat artikel test.')
        ->set('kategoriId', (string) $kategori->id)
        ->set('tagDipilih', [$tag->id])
        ->set('status', 'diterbitkan')
        ->call('simpan');

    $this->assertDatabaseHas('artikels', [
        'judul' => 'Artikel Test Baru',
        'user_id' => $user->id,
        'status' => 'diterbitkan',
    ]);
});

test('buat artikel gagal jika judul kosong', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test('pages::portal.artikel.create')
        ->set('judul', '')
        ->set('konten', 'Konten cukup panjang untuk validasi minimum karakter.')
        ->call('simpan')
        ->assertHasErrors(['judul']);
});

// ===================== PORTAL EDIT ARTIKEL =====================

test('halaman edit artikel bisa diakses', function () {
    $user = User::factory()->create();
    $artikel = Artikel::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)
        ->get(route('portal.artikel.edit', $artikel->id))
        ->assertOk();
});

test('pengguna bisa memperbarui artikel yang ada', function () {
    $user = User::factory()->create();
    $artikel = Artikel::factory()->draft()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test('pages::portal.artikel.edit', ['id' => $artikel->id])
        ->set('judul', 'Judul Artikel Diperbarui')
        ->set('status', 'diterbitkan')
        ->call('simpan');

    expect($artikel->fresh()->judul)->toBe('Judul Artikel Diperbarui')
        ->and($artikel->fresh()->status)->toBe('diterbitkan');
});
