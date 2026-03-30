<?php

namespace App\Filament\Resources\ArtikelResource\Pages;

use App\Filament\Resources\ArtikelResource;
use App\Models\Article as Artikel;
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
                ->label('Write Article'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All')
                ->badge(Artikel::count()),

            'draft' => Tab::make('Draft')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'draft'))
                ->badge(Artikel::where('status', 'draft')->count()),

            'published' => Tab::make('Published')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'published'))
                ->badge(Artikel::where('status', 'published')->count()),

            'archived' => Tab::make('Archived')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'archived'))
                ->badge(Artikel::where('status', 'archived')->count()),

            'featured' => Tab::make('Featured')
                ->modifyQueryUsing(fn ($query) => $query->where('featured', true))
                ->badge(Artikel::where('featured', true)->count()),
        ];
    }
}
