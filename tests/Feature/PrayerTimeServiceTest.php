<?php

use App\Services\PrayerTimeService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

beforeEach(function () {
    Cache::flush();
});

it('returns cached prayer times when available', function () {
    $cached = [
        'Subuh' => '04:30',
        'Syuruq' => '05:45',
        'Dzuhur' => '11:52',
        'Ashar' => '15:09',
        'Maghrib' => '17:48',
        'Isya' => '18:59',
    ];

    Cache::put('prayer_times_'.now()->format('Y-m-d'), $cached);

    Http::fake();

    $service = new PrayerTimeService;
    $result = $service->getTodayTimings();

    expect($result)->toBe($cached);
    Http::assertNothingSent();
});

it('fetches from api and maps keys correctly', function () {
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

    $service = new PrayerTimeService;
    $result = $service->getTodayTimings();

    expect($result)->toBe([
        'Subuh' => '04:30',
        'Syuruq' => '05:45',
        'Dzuhur' => '11:52',
        'Ashar' => '15:09',
        'Maghrib' => '17:48',
        'Isya' => '18:59',
    ]);
});

it('returns fallback when api fails', function () {
    Http::fake([
        'api.aladhan.com/*' => Http::response([], 500),
    ]);

    Log::spy();

    $service = new PrayerTimeService;
    $result = $service->getTodayTimings();

    expect($result)->each->toBe('--:--');
});

it('returns fallback when api throws exception', function () {
    Http::fake(function () {
        throw new \Exception('Connection refused');
    });

    Log::spy();

    $service = new PrayerTimeService;
    $result = $service->getTodayTimings();

    expect($result)->each->toBe('--:--');
});

it('caches result for the rest of the day', function () {
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

    $service = new PrayerTimeService;
    $service->getTodayTimings();
    $service->getTodayTimings();

    Http::assertSentCount(1);
});
