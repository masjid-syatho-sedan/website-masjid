<?php

namespace App\Filament\Resources\TagResource\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Actions\Action as FilamentAction;
use Filament\Tables;
use Filament\Tables\Table;

class ArtikelsRelationManager extends RelationManager
{
    protected static string $relationship = 'artikels';

    protected static ?string $title = 'Artikel dengan Tag Ini';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('judul')
                ->label('Judul')
                ->required()
                ->maxLength(255),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('judul')
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('')
                    ->height(40)
                    ->width(60),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(60),

                Tables\Columns\TextColumn::make('kategori.nama')
                    ->label('Kategori')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diterbitkan' => 'success',
                        'draft' => 'warning',
                        'diarsipkan' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'diterbitkan' => 'Diterbitkan',
                        'draft' => 'Draft',
                        'diarsipkan' => 'Diarsipkan',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('diterbitkan_pada')
                    ->label('Diterbitkan')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([])
            ->headerActions([])
            ->actions([
                FilamentAction::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-o-pencil')
                    ->url(fn ($record) => route('filament.admin.resources.artikels.edit', $record)),
            ])
            ->bulkActions([])
            ->defaultSort('created_at', 'desc');
    }
}
