<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ArtikelResource;
use App\Models\Article;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class ArtikelTerbaruWidget extends TableWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Artikel Terbaru')
            ->description('8 artikel yang baru saja ditambahkan atau diperbarui')
            ->query(
                Article::query()->latest()->limit(8)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('')
                    ->height(40)
                    ->width(60)
                    ->defaultImageUrl(fn () => null)
                    ->extraImgAttributes(['class' => 'rounded']),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(55)
                    ->description(fn (Article $record): string => $record->category?->name ?? '—'),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Penulis')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        'archived' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'published' => 'Diterbitkan',
                        'draft' => 'Draft',
                        'archived' => 'Diarsipkan',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('views')
                    ->label('Dilihat')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal Terbit')
                    ->dateTime('d M Y')
                    ->placeholder('Belum diterbitkan')
                    ->sortable(),
            ])
            ->actions([
                Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (Article $record): string => ArtikelResource::getUrl('edit', ['record' => $record])),

                Action::make('terbitkan')
                    ->label('Terbitkan')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->visible(fn (Article $record): bool => $record->status !== 'published')
                    ->action(fn (Article $record) => $record->update([
                        'status' => 'published',
                        'published_at' => $record->published_at ?? now(),
                    ]))
                    ->requiresConfirmation(),
            ])
            ->paginated(false);
    }
}
