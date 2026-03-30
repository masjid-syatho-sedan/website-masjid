<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Actions\Action as FilamentAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static \UnitEnum|string|null $navigationGroup = 'Management';

    protected static ?string $navigationLabel = 'Users';

    protected static ?string $modelLabel = 'User';

    protected static ?string $pluralModelLabel = 'Users';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Group::make()
                ->schema([
                    Section::make('Personal Information')
                        ->description('Basic identity information for the user account.')
                        ->schema([
                            TextInput::make('name')
                                ->label('Full Name')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('email')
                                ->label('Email Address')
                                ->email()
                                ->required()
                                ->maxLength(255)
                                ->unique(User::class, 'email', ignoreRecord: true),
                        ])
                        ->columns(2),

                    Section::make('Password')
                        ->description('Leave blank to keep the current password.')
                        ->schema([
                            TextInput::make('password')
                                ->label('New Password')
                                ->password()
                                ->revealable()
                                ->minLength(8)
                                ->maxLength(255)
                                ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                                ->dehydrated(fn ($state) => filled($state))
                                ->required(fn (string $operation) => $operation === 'create'),

                            TextInput::make('password_confirmation')
                                ->label('Confirm Password')
                                ->password()
                                ->revealable()
                                ->same('password')
                                ->dehydrated(false)
                                ->required(fn (string $operation) => $operation === 'create'),
                        ])
                        ->columns(2),
                ])
                ->columnSpan(2),

            Group::make()
                ->schema([
                    Section::make('Roles & Permissions')
                        ->description('Assign roles to control what this user can access.')
                        ->schema([
                            Select::make('roles')
                                ->label('Roles')
                                ->multiple()
                                ->relationship('roles', 'name')
                                ->preload()
                                ->searchable()
                                ->helperText('A user can have multiple roles.'),
                        ]),

                    Section::make('Account Status')
                        ->description('Manage verification and account access.')
                        ->schema([
                            Toggle::make('email_verified')
                                ->label('Email Verified')
                                ->helperText('Toggle to manually verify or unverify this email.')
                                ->default(false)
                                ->dehydrated(false)
                                ->afterStateHydrated(function ($component, $record) {
                                    $component->state($record?->email_verified_at !== null);
                                })
                                ->afterStateUpdated(function ($state, $record) {
                                    if ($record) {
                                        $record->update([
                                            'email_verified_at' => $state ? now() : null,
                                        ]);
                                    }
                                })
                                ->live(),

                            DateTimePicker::make('email_verified_at')
                                ->label('Verified At')
                                ->displayFormat('d M Y, H:i')
                                ->disabled()
                                ->dehydrated(false)
                                ->visible(fn ($record) => $record?->email_verified_at !== null),

                            TextInput::make('google_id')
                                ->label('Google ID')
                                ->disabled()
                                ->dehydrated(false)
                                ->helperText('Set when user registers via Google OAuth.')
                                ->placeholder('Not connected'),
                        ]),
                ])
                ->columnSpan(1),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (User $record) => $record->email),

                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable()
                    ->separator(', '),

                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label('Verified')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable()
                    ->tooltip(fn (User $record) => $record->email_verified_at
                        ? 'Verified on '.$record->email_verified_at->format('d M Y, H:i')
                        : 'Email not verified'),

                Tables\Columns\IconColumn::make('two_factor_confirmed_at')
                    ->label('2FA')
                    ->boolean()
                    ->trueIcon('heroicon-o-shield-check')
                    ->falseIcon('heroicon-o-shield-exclamation')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->sortable()
                    ->tooltip(fn (User $record) => $record->two_factor_confirmed_at
                        ? '2FA active since '.$record->two_factor_confirmed_at->format('d M Y')
                        : '2FA not enabled'),

                Tables\Columns\IconColumn::make('google_id')
                    ->label('Google')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-minus-circle')
                    ->trueColor('info')
                    ->falseColor('gray')
                    ->tooltip(fn (User $record) => $record->google_id
                        ? 'Connected: '.$record->google_id
                        : 'Not connected via Google'),

                Tables\Columns\TextColumn::make('articles_count')
                    ->label('Articles')
                    ->counts('articles')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Joined')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('roles')
                    ->label('Role')
                    ->relationship('roles', 'name')
                    ->preload()
                    ->multiple(),

                Tables\Filters\TernaryFilter::make('email_verified_at')
                    ->label('Email Verified')
                    ->nullable()
                    ->trueLabel('Verified')
                    ->falseLabel('Not verified'),

                Tables\Filters\TernaryFilter::make('two_factor_confirmed_at')
                    ->label('2FA Enabled')
                    ->nullable()
                    ->trueLabel('Enabled')
                    ->falseLabel('Disabled'),

                Tables\Filters\TernaryFilter::make('google_id')
                    ->label('Google Account')
                    ->nullable()
                    ->trueLabel('Connected')
                    ->falseLabel('Not connected'),

                Filter::make('created_at')
                    ->schema([
                        \Filament\Forms\Components\DatePicker::make('dari')
                            ->label('Joined From'),
                        \Filament\Forms\Components\DatePicker::make('sampai')
                            ->label('Joined Until'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['dari'], fn ($q) => $q->whereDate('created_at', '>=', $data['dari']))
                            ->when($data['sampai'], fn ($q) => $q->whereDate('created_at', '<=', $data['sampai']));
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),

                    FilamentAction::make('verifikasi_email')
                        ->label('Verify Email')
                        ->icon('heroicon-o-check-badge')
                        ->color('success')
                        ->visible(fn (User $record) => $record->email_verified_at === null)
                        ->action(fn (User $record) => $record->update(['email_verified_at' => now()]))
                        ->requiresConfirmation()
                        ->modalHeading('Verify Email')
                        ->modalDescription('Are you sure you want to manually verify this email?'),

                    FilamentAction::make('batalkan_verifikasi')
                        ->label('Revoke Verification')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->visible(fn (User $record) => $record->email_verified_at !== null)
                        ->action(fn (User $record) => $record->update(['email_verified_at' => null]))
                        ->requiresConfirmation()
                        ->modalHeading('Revoke Email Verification')
                        ->modalDescription('This will mark the email as unverified. The user will need to verify again.'),

                    FilamentAction::make('kirim_reset_password')
                        ->label('Send Password Reset')
                        ->icon('heroicon-o-key')
                        ->color('info')
                        ->visible(fn (User $record) => $record->google_id === null)
                        ->action(function (User $record) {
                            Password::sendResetLink(['email' => $record->email]);
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Send Password Reset')
                        ->modalDescription('A password reset link will be sent to the user\'s email address.'),

                    FilamentAction::make('reset_2fa')
                        ->label('Reset 2FA')
                        ->icon('heroicon-o-shield-exclamation')
                        ->color('danger')
                        ->visible(fn (User $record) => $record->two_factor_confirmed_at !== null)
                        ->action(function (User $record) {
                            $record->update([
                                'two_factor_secret' => null,
                                'two_factor_recovery_codes' => null,
                                'two_factor_confirmed_at' => null,
                            ]);
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Reset Two-Factor Authentication')
                        ->modalDescription('This will disable 2FA for this user. They will need to set it up again.'),

                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('verifikasi_semua')
                        ->label('Verify Email')
                        ->icon('heroicon-o-check-badge')
                        ->color('success')
                        ->action(fn ($records) => $records->each(fn (User $record) => $record->email_verified_at === null
                            ? $record->update(['email_verified_at' => now()])
                            : null))
                        ->requiresConfirmation(),

                    BulkAction::make('assign_role')
                        ->label('Assign Role')
                        ->icon('heroicon-o-tag')
                        ->color('primary')
                        ->form([
                            Select::make('role')
                                ->label('Role')
                                ->options(Role::pluck('name', 'name'))
                                ->required(),
                        ])
                        ->action(fn ($records, array $data) => $records->each->assignRole($data['role']))
                        ->requiresConfirmation(),

                    BulkAction::make('cabut_role')
                        ->label('Revoke Role')
                        ->icon('heroicon-o-x-mark')
                        ->color('warning')
                        ->form([
                            Select::make('role')
                                ->label('Role')
                                ->options(Role::pluck('name', 'name'))
                                ->required(),
                        ])
                        ->action(fn ($records, array $data) => $records->each->removeRole($data['role']))
                        ->requiresConfirmation(),

                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelationManagers(): array
    {
        return [
            RelationManagers\ArticlesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
