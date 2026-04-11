<?php

namespace App\Filament\Resources\AmbulanceJournalResource\Pages;

use App\Filament\Resources\AmbulanceJournalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAmbulanceJournal extends EditRecord
{
    protected static string $resource = AmbulanceJournalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
