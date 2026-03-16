<?php

namespace App\Filament\Resources\ArtikelResource\Pages;

use App\Filament\Resources\ArtikelResource;
use App\Models\Artikel;
use Filament\Actions;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Resources\Pages\ListRecords;

class ListArtikels extends ListRecords
{
    protected static string $resource = ArtikelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tulis Artikel'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'semua' => Tab::make('Semua')
                ->badge(Artikel::count()),

            'draft' => Tab::make('Draft')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'draft'))
                ->badge(Artikel::where('status', 'draft')->count()),

            'diterbitkan' => Tab::make('Diterbitkan')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'diterbitkan'))
                ->badge(Artikel::where('status', 'diterbitkan')->count()),

            'diarsipkan' => Tab::make('Diarsipkan')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'diarsipkan'))
                ->badge(Artikel::where('status', 'diarsipkan')->count()),

            'unggulan' => Tab::make('Unggulan')
                ->modifyQueryUsing(fn ($query) => $query->where('unggulan', true))
                ->badge(Artikel::where('unggulan', true)->count()),
        ];
    }
}
