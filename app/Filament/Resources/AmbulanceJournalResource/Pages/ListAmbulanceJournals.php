<?php

namespace App\Filament\Resources\AmbulanceJournalResource\Pages;

use App\Filament\Resources\AmbulanceJournalResource;
use App\Models\AmbulanceJournal;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListAmbulanceJournals extends ListRecords
{
    protected static string $resource = AmbulanceJournalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tulis Jurnal'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->badge(AmbulanceJournal::count()),

            'draft' => Tab::make('Draft')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'draft'))
                ->badge(AmbulanceJournal::where('status', 'draft')->count()),

            'published' => Tab::make('Published')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'published'))
                ->badge(AmbulanceJournal::where('status', 'published')->count()),
        ];
    }
}
