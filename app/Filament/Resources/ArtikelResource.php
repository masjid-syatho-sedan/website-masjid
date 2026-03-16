<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtikelResource\Pages;
use App\Models\Artikel;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Actions\Action as FilamentAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArtikelResource extends Resource
{
    protected static ?string $model = Artikel::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static \UnitEnum|string|null $navigationGroup = 'Konten';

    protected static ?string $navigationLabel = 'Artikel';

    protected static ?string $modelLabel = 'Artikel';

    protected static ?string $pluralModelLabel = 'Artikel';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Group::make()
                ->schema([
                    Section::make('Informasi Artikel')
                        ->schema([
                            TextInput::make('judul')
                                ->label('Judul')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                    if ($operation !== 'create') {
                                        return;
                                    }
                                    $set('slug', Str::slug($state));
                                }),

                            TextInput::make('slug')
                                ->label('Slug URL')
                                ->required()
                                ->maxLength(255)
                                ->unique(Artikel::class, 'slug', ignoreRecord: true)
                                ->helperText('URL artikel, diisi otomatis dari judul.'),

                            Textarea::make('ringkasan')
                                ->label('Ringkasan')
                                ->rows(3)
                                ->maxLength(500)
                                ->columnSpanFull()
                                ->helperText('Ringkasan singkat artikel (maks. 500 karakter).'),
                        ])
                        ->columns(2),

                    Section::make('Konten Artikel')
                        ->schema([
                            RichEditor::make('konten')
                                ->label('')
                                ->required()
                                ->toolbarButtons([
                                    'attachFiles',
                                    'blockquote',
                                    'bold',
                                    'bulletList',
                                    'codeBlock',
                                    'h2',
                                    'h3',
                                    'italic',
                                    'link',
                                    'orderedList',
                                    'redo',
                                    'strike',
                                    'underline',
                                    'undo',
                                ])
                                ->fileAttachmentsDisk('public')
                                ->fileAttachmentsDirectory('artikel/lampiran')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Gambar Utama')
                        ->schema([
                            FileUpload::make('gambar')
                                ->label('')
                                ->image()
                                ->imageEditor()
                                ->imageResizeMode('cover')
                                ->imageCropAspectRatio('16:9')
                                ->directory('artikel/gambar')
                                ->disk('public')
                                ->columnSpanFull(),
                        ]),
                ])
                ->columnSpan(2),

            Group::make()
                ->schema([
                    Section::make('Penerbitan')
                        ->schema([
                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    'draft' => 'Draft',
                                    'diterbitkan' => 'Diterbitkan',
                                    'diarsipkan' => 'Diarsipkan',
                                ])
                                ->default('draft')
                                ->required()
                                ->live(),

                            DateTimePicker::make('diterbitkan_pada')
                                ->label('Tanggal Terbit')
                                ->default(now())
                                ->visible(fn (Get $get) => $get('status') === 'diterbitkan'),

                            Toggle::make('unggulan')
                                ->label('Artikel Unggulan')
                                ->default(false)
                                ->helperText('Tampilkan di bagian unggulan halaman depan.'),
                        ]),

                    Section::make('Klasifikasi')
                        ->schema([
                            Select::make('kategori_id')
                                ->label('Kategori')
                                ->relationship('kategori', 'nama')
                                ->searchable()
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('nama')
                                        ->label('Nama Kategori')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn ($state, Set $set) => $set('slug', Str::slug($state))),

                                    TextInput::make('slug')
                                        ->label('Slug')
                                        ->required(),

                                    Textarea::make('deskripsi')
                                        ->label('Deskripsi')
                                        ->rows(2),

                                    ColorPicker::make('warna')
                                        ->label('Warna Badge')
                                        ->default('#b45309'),
                                ]),

                            Select::make('tags')
                                ->label('Tag')
                                ->relationship('tags', 'nama')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('nama')
                                        ->label('Nama Tag')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn ($state, Set $set) => $set('slug', Str::slug($state))),

                                    TextInput::make('slug')
                                        ->label('Slug')
                                        ->required(),
                                ]),
                        ]),

                    Section::make('Statistik')
                        ->schema([
                            TextInput::make('dilihat')
                                ->label('Jumlah Dilihat')
                                ->numeric()
                                ->default(0)
                                ->disabled()
                                ->dehydrated(false),
                        ])
                        ->collapsed(),
                ])
                ->columnSpan(1),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('')
                    ->height(48)
                    ->width(72),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->description(fn (Artikel $record) => $record->kategori?->nama),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Penulis')
                    ->sortable()
                    ->toggleable(),

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

                Tables\Columns\IconColumn::make('unggulan')
                    ->label('Unggulan')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                Tables\Columns\TextColumn::make('dilihat')
                    ->label('Dilihat')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('diterbitkan_pada')
                    ->label('Diterbitkan')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(),

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
                        'diterbitkan' => 'Diterbitkan',
                        'diarsipkan' => 'Diarsipkan',
                    ]),

                Tables\Filters\SelectFilter::make('kategori_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama')
                    ->preload(),

                Tables\Filters\TernaryFilter::make('unggulan')
                    ->label('Unggulan'),

                Filter::make('diterbitkan_pada')
                    ->schema([
                        \Filament\Forms\Components\DatePicker::make('dari')
                            ->label('Dari Tanggal'),
                        \Filament\Forms\Components\DatePicker::make('sampai')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['dari'], fn ($q) => $q->whereDate('diterbitkan_pada', '>=', $data['dari']))
                            ->when($data['sampai'], fn ($q) => $q->whereDate('diterbitkan_pada', '<=', $data['sampai']));
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    FilamentAction::make('terbitkan')
                        ->label('Terbitkan')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn (Artikel $record) => $record->status !== 'diterbitkan')
                        ->action(function (Artikel $record) {
                            $record->update([
                                'status' => 'diterbitkan',
                                'diterbitkan_pada' => $record->diterbitkan_pada ?? now(),
                            ]);
                        })
                        ->requiresConfirmation(),
                    FilamentAction::make('arsipkan')
                        ->label('Arsipkan')
                        ->icon('heroicon-o-archive-box')
                        ->color('gray')
                        ->visible(fn (Artikel $record) => $record->status !== 'diarsipkan')
                        ->action(fn (Artikel $record) => $record->update(['status' => 'diarsipkan']))
                        ->requiresConfirmation(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('terbitkan_semua')
                        ->label('Terbitkan')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update([
                            'status' => 'diterbitkan',
                            'diterbitkan_pada' => now(),
                        ]))
                        ->requiresConfirmation(),
                    BulkAction::make('arsipkan_semua')
                        ->label('Arsipkan')
                        ->icon('heroicon-o-archive-box')
                        ->color('gray')
                        ->action(fn ($records) => $records->each->update(['status' => 'diarsipkan']))
                        ->requiresConfirmation(),
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelationManagers(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArtikels::route('/'),
            'create' => Pages\CreateArtikel::route('/create'),
            'view' => Pages\ViewArtikel::route('/{record}'),
            'edit' => Pages\EditArtikel::route('/{record}/edit'),
        ];
    }
}
