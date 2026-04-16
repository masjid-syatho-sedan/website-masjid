<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GeneralJournalResource\Pages;
use App\Models\GeneralJournal;
use App\Models\User;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class GeneralJournalResource extends Resource
{
    protected static ?string $model = GeneralJournal::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static \UnitEnum|string|null $navigationGroup = 'Jurnal';

    protected static ?string $navigationLabel = 'Jurnal Umum';

    protected static ?string $modelLabel = 'Jurnal';

    protected static ?string $pluralModelLabel = 'Jurnal Umum';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Group::make()
                ->schema([
                    Section::make('Informasi Jurnal')
                        ->schema([
                            TextInput::make('title')
                                ->label('Judul')
                                ->required()
                                ->maxLength(255),

                            DatePicker::make('journal_date')
                                ->label('Tanggal')
                                ->required()
                                ->default(today()),

                            Textarea::make('description')
                                ->label('Deskripsi')
                                ->rows(4)
                                ->columnSpanFull(),
                        ])
                        ->columns(2),

                    Section::make('Daftar Tugas / Kegiatan')
                        ->schema([
                            Repeater::make('tasks')
                                ->label('')
                                ->schema([
                                    TextInput::make('task')
                                        ->label('Kegiatan')
                                        ->required()
                                        ->placeholder('Contoh: Membersihkan area masjid'),
                                ])
                                ->addActionLabel('Tambah Kegiatan')
                                ->reorderable()
                                ->collapsible()
                                ->defaultItems(1),
                        ]),

                    Section::make('Foto Dokumentasi')
                        ->schema([
                            FileUpload::make('images')
                                ->label('')
                                ->image()
                                ->multiple()
                                ->reorderable()
                                ->imageEditor()
                                ->directory('general-journals/images')
                                ->disk('public')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Video Dokumentasi')
                        ->schema([
                            FileUpload::make('videos')
                                ->label('')
                                ->multiple()
                                ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg', 'video/quicktime'])
                                ->directory('general-journals/videos')
                                ->disk('public')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Tautan / Link')
                        ->schema([
                            Repeater::make('links')
                                ->label('')
                                ->schema([
                                    TextInput::make('label')
                                        ->label('Judul Link')
                                        ->required()
                                        ->placeholder('Contoh: Berita Terkait'),

                                    TextInput::make('url')
                                        ->label('URL')
                                        ->required()
                                        ->url()
                                        ->placeholder('https://...'),
                                ])
                                ->columns(2)
                                ->addActionLabel('Tambah Link')
                                ->reorderable()
                                ->collapsible()
                                ->defaultItems(0),
                        ]),
                ])
                ->columnSpan(2),

            Group::make()
                ->schema([
                    Section::make('Publikasi')
                        ->schema([
                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    'draft' => 'Draft',
                                    'published' => 'Published',
                                ])
                                ->default('draft')
                                ->required(),

                            Select::make('user_id')
                                ->label('Penulis')
                                ->options(User::orderBy('name')->pluck('name', 'id'))
                                ->searchable()
                                ->preload()
                                ->required(),
                        ]),
                ])
                ->columnSpan(1),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('journal_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('user_id')
                    ->label('Penulis')
                    ->formatStateUsing(fn ($state) => User::find($state)?->name ?? '-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tasks')
                    ->label('Kegiatan')
                    ->formatStateUsing(fn ($state) => $state ? count($state).' kegiatan' : '-')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'published' => 'Published',
                        'draft' => 'Draft',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),

                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Penulis')
                    ->options(User::orderBy('name')->pluck('name', 'id'))
                    ->searchable(),

                Filter::make('journal_date')
                    ->schema([
                        DatePicker::make('dari')
                            ->label('Dari Tanggal'),
                        DatePicker::make('sampai')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['dari'], fn ($q) => $q->whereDate('journal_date', '>=', $data['dari']))
                            ->when($data['sampai'], fn ($q) => $q->whereDate('journal_date', '<=', $data['sampai']));
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('publish_all')
                        ->label('Publish')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['status' => 'published']))
                        ->requiresConfirmation(),
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('journal_date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGeneralJournals::route('/'),
            'create' => Pages\CreateGeneralJournal::route('/create'),
            'view' => Pages\ViewGeneralJournal::route('/{record}'),
            'edit' => Pages\EditGeneralJournal::route('/{record}/edit'),
        ];
    }
}
