<?php

namespace App\Livewire;

use App\Services\PrayerTimeService;
use Livewire\Component;

class WaktuSholat extends Component
{
    public array $timings = [];

    public string $currentPrayer = '';

    public function mount(PrayerTimeService $service): void
    {
        $this->timings = $service->getTodayTimings();
        $this->currentPrayer = $this->detectCurrentPrayer();
    }

    private function detectCurrentPrayer(): string
    {
        $now = now()->format('H:i');

        $order = ['Subuh', 'Dzuhur', 'Ashar', 'Maghrib', 'Isya'];

        $current = '';

        foreach ($order as $name) {
            $time = $this->timings[$name] ?? null;
            if ($time && $time !== '--:--' && $now >= $time) {
                $current = $name;
            }
        }

        return $current ?: 'Isya';
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.waktu-sholat');
    }
}
