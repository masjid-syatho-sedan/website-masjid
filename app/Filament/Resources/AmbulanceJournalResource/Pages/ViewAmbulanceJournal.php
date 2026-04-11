<?php

namespace App\Filament\Resources\AmbulanceJournalResource\Pages;

use App\Filament\Resources\AmbulanceJournalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAmbulanceJournal extends ViewRecord
{
    protected static string $resource = AmbulanceJournalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
