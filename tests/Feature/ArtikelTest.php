<?php

use App\Models\Article;
use Livewire\Livewire;

// ===================== PUBLIC ARTICLE PAGES =====================

test('halaman /artikel bisa diakses oleh publik', function () {
    $this->get(route('blog'))->assertOk();
});

test('halaman /artikel menampilkan artikel yang diterbitkan', function () {
    $article = Article::factory()->published()->create();

    $this->get(route('blog'))->assertSee($article->title);
});

test('halaman /artikel tidak menampilkan artikel draft', function () {
    $article = Article::factory()->draft()->create(['title' => 'Artikel Tersembunyi Draft']);

    $this->get(route('blog'))->assertDontSee('Artikel Tersembunyi Draft');
});

test('komponen public artikel index bisa melakukan pencarian', function () {
    $article = Article::factory()->published()->create(['title' => 'Artikel Khusus Unik XYZ']);
    Article::factory()->published()->create(['title' => 'Artikel Biasa ABC']);

    Livewire::test('pages::artikel.index')
        ->set('cari', 'Khusus Unik XYZ')
        ->assertSee('Artikel Khusus Unik XYZ')
        ->assertDontSee('Artikel Biasa ABC');
});

// ===================== ARTICLE DETAIL PAGES =====================

test('halaman detail artikel yang diterbitkan bisa diakses', function () {
    $article = Article::factory()->published()->create();

    $this->get(route('artikel.show', $article->slug))
        ->assertOk()
        ->assertSee($article->title);
});

test('halaman detail artikel draft tidak bisa diakses publik', function () {
    $article = Article::factory()->draft()->create();

    $this->get(route('artikel.show', $article->slug))->assertNotFound();
});

test('view count bertambah ketika artikel dilihat', function () {
    $article = Article::factory()->published()->create(['views' => 0]);

    $this->get(route('artikel.show', $article->slug));

    expect($article->fresh()->views)->toBe(1);
});
