<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PrayerTimeService
{
    // Koordinat Masjid Syatho Sedan, Rembang
    private const LATITUDE = -6.7677443;

    private const LONGITUDE = 111.5741508;

    // Method 11: Singapore Muslim Religious Council (umum dipakai di Asia Tenggara)
    private const METHOD = 11;

    public function getTodayTimings(): array
    {
        $cacheKey = 'prayer_times_'.now()->format('Y-m-d');

        return Cache::remember($cacheKey, now()->endOfDay(), function () {
            return $this->fetchFromApi();
        });
    }

    private function fetchFromApi(): array
    {
        try {
            $timestamp = now()->timestamp;

            $response = Http::timeout(10)->get("https://api.aladhan.com/v1/timings/{$timestamp}", [
                'latitude' => self::LATITUDE,
                'longitude' => self::LONGITUDE,
                'method' => self::METHOD,
            ]);

            if ($response->successful()) {
                $data = $response->json('data.timings');

                return [
                    'Subuh' => $data['Fajr'] ?? '--:--',
                    'Syuruq' => $data['Sunrise'] ?? '--:--',
                    'Dzuhur' => $data['Dhuhr'] ?? '--:--',
                    'Ashar' => $data['Asr'] ?? '--:--',
                    'Maghrib' => $data['Maghrib'] ?? '--:--',
                    'Isya' => $data['Isha'] ?? '--:--',
                ];
            }

            Log::warning('PrayerTimeService: API response not successful', [
                'status' => $response->status(),
            ]);
        } catch (\Exception $e) {
            Log::error('PrayerTimeService: Failed to fetch prayer times', [
                'error' => $e->getMessage(),
            ]);
        }

        return $this->fallback();
    }

    private function fallback(): array
    {
        return [
            'Subuh' => '--:--',
            'Syuruq' => '--:--',
            'Dzuhur' => '--:--',
            'Ashar' => '--:--',
            'Maghrib' => '--:--',
            'Isya' => '--:--',
        ];
    }
}
