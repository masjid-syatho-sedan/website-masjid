<?php

use App\Services\PrayerTimeService;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;

beforeEach(function () {
    Http::fake([
        'api.aladhan.com/*' => Http::response([
            'data' => [
                'timings' => [
                    'Fajr' => '04:30',
                    'Sunrise' => '05:45',
                    'Dhuhr' => '11:52',
                    'Asr' => '15:09',
                    'Maghrib' => '17:48',
                    'Isha' => '18:59',
                ],
            ],
        ], 200),
    ]);
});

it('renders waktu sholat component with prayer times', function () {
    Livewire::test(\App\Livewire\WaktuSholat::class)
        ->assertSee('04:30')
        ->assertSee('11:52')
        ->assertSee('15:09')
        ->assertSee('17:48')
        ->assertSee('18:59')
        ->assertSee('Subuh')
        ->assertSee('Dzuhur')
        ->assertSee('Ashar')
        ->assertSee('Maghrib')
        ->assertSee('Isya');
});

it('does not show syuruq in the view', function () {
    Livewire::test(\App\Livewire\WaktuSholat::class)
        ->assertDontSee('Syuruq');
});

it('shows location info', function () {
    Livewire::test(\App\Livewire\WaktuSholat::class)
        ->assertSee('Sedan, Kab. Rembang');
});

it('shows on home page', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('Jadwal Sholat');
});
