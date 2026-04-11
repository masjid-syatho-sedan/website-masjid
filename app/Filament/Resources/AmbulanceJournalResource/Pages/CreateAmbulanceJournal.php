<?php

namespace App\Filament\Resources\AmbulanceJournalResource\Pages;

use App\Filament\Resources\AmbulanceJournalResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAmbulanceJournal extends CreateRecord
{
    protected static string $resource = AmbulanceJournalResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
