<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtikelResource\Pages;
use App\Models\Article as Artikel;
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

    protected static \UnitEnum|string|null $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Articles';

    protected static ?string $modelLabel = 'Article';

    protected static ?string $pluralModelLabel = 'Articles';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Group::make()
                ->schema([
                    Section::make('Article Information')
                        ->schema([
                            TextInput::make('title')
                                ->label('Title')
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
                                ->label('URL Slug')
                                ->required()
                                ->maxLength(255)
                                ->unique(Artikel::class, 'slug', ignoreRecord: true)
                                ->helperText('Article URL, auto-filled from title.'),

                            Textarea::make('excerpt')
                                ->label('Summary')
                                ->rows(3)
                                ->maxLength(500)
                                ->columnSpanFull()
                                ->helperText('Brief article summary (max. 500 characters).'),
                        ])
                        ->columns(2),

                    Section::make('Article Content')
                        ->schema([
                            RichEditor::make('content')
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
                                ->fileAttachmentsDirectory('articles/attachments')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Featured Image')
                        ->schema([
                            FileUpload::make('image')
                                ->label('')
                                ->image()
                                ->imageEditor()
                                ->imageResizeMode('cover')
                                ->imageCropAspectRatio('16:9')
                                ->directory('articles/images')
                                ->disk('public')
                                ->columnSpanFull(),
                        ]),
                ])
                ->columnSpan(2),

            Group::make()
                ->schema([
                    Section::make('Publication')
                        ->schema([
                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    'draft' => 'Draft',
                                    'published' => 'Published',
                                    'archived' => 'Archived',
                                ])
                                ->default('draft')
                                ->required()
                                ->live(),

                            DateTimePicker::make('published_at')
                                ->label('Publish Date')
                                ->default(now())
                                ->visible(fn (Get $get) => $get('status') === 'published'),

                            Toggle::make('featured')
                                ->label('Featured Article')
                                ->default(false)
                                ->helperText('Show in the featured section on the front page.'),
                        ]),

                    Section::make('Classification')
                        ->schema([
                            Select::make('category_id')
                                ->label('Category')
                                ->relationship('category', 'name')
                                ->searchable()
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->label('Category Name')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn ($state, Set $set) => $set('slug', Str::slug($state))),

                                    TextInput::make('slug')
                                        ->label('Slug')
                                        ->required(),

                                    Textarea::make('description')
                                        ->label('Description')
                                        ->rows(2),

                                    ColorPicker::make('color')
                                        ->label('Badge Color')
                                        ->default('#b45309'),
                                ]),

                            Select::make('tags')
                                ->label('Tags')
                                ->relationship('tags', 'name')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->label('Tag Name')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn ($state, Set $set) => $set('slug', Str::slug($state))),

                                    TextInput::make('slug')
                                        ->label('Slug')
                                        ->required(),
                                ]),
                        ]),

                    Section::make('Statistics')
                        ->schema([
                            TextInput::make('views')
                                ->label('View Count')
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
                Tables\Columns\ImageColumn::make('image')
                    ->label('')
                    ->height(48)
                    ->width(72),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->description(fn (Artikel $record) => $record->category?->name),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Author')
                    ->sortable()
                    ->toggleable(),

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
                        'published' => 'Published',
                        'draft' => 'Draft',
                        'archived' => 'Archived',
                        default => $state,
                    }),

                Tables\Columns\IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                Tables\Columns\TextColumn::make('views')
                    ->label('Views')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Published')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
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
                        'archived' => 'Archived',
                    ]),

                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->preload(),

                Tables\Filters\SelectFilter::make('tags')
                    ->label('Tag')
                    ->relationship('tags', 'name')
                    ->preload()
                    ->multiple(),

                Tables\Filters\TernaryFilter::make('featured')
                    ->label('Featured'),

                Filter::make('published_at')
                    ->schema([
                        \Filament\Forms\Components\DatePicker::make('dari')
                            ->label('From Date'),
                        \Filament\Forms\Components\DatePicker::make('sampai')
                            ->label('To Date'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['dari'], fn ($q) => $q->whereDate('published_at', '>=', $data['dari']))
                            ->when($data['sampai'], fn ($q) => $q->whereDate('published_at', '<=', $data['sampai']));
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    FilamentAction::make('terbitkan')
                        ->label('Publish')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn (Artikel $record) => $record->status !== 'published')
                        ->action(function (Artikel $record) {
                            $record->update([
                                'status' => 'published',
                                'published_at' => $record->published_at ?? now(),
                            ]);
                        })
                        ->requiresConfirmation(),
                    FilamentAction::make('arsipkan')
                        ->label('Archive')
                        ->icon('heroicon-o-archive-box')
                        ->color('gray')
                        ->visible(fn (Artikel $record) => $record->status !== 'archived')
                        ->action(fn (Artikel $record) => $record->update(['status' => 'archived']))
                        ->requiresConfirmation(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('terbitkan_semua')
                        ->label('Publish')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update([
                            'status' => 'published',
                            'published_at' => now(),
                        ]))
                        ->requiresConfirmation(),
                    BulkAction::make('arsipkan_semua')
                        ->label('Archive')
                        ->icon('heroicon-o-archive-box')
                        ->color('gray')
                        ->action(fn ($records) => $records->each->update(['status' => 'archived']))
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
