<?php

use App\Models\Artikel;
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

