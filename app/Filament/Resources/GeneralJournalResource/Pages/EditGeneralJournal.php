<?php

namespace App\Filament\Resources\GeneralJournalResource\Pages;

use App\Filament\Resources\GeneralJournalResource;
use Filament\Resources\Pages\EditRecord;

class EditGeneralJournal extends EditRecord
{
    protected static string $resource = GeneralJournalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
