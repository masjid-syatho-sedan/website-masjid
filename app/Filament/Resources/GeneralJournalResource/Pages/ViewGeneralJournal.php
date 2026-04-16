<?php

namespace App\Filament\Resources\GeneralJournalResource\Pages;

use App\Filament\Resources\GeneralJournalResource;
use Filament\Resources\Pages\ViewRecord;

class ViewGeneralJournal extends ViewRecord
{
    protected static string $resource = GeneralJournalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
