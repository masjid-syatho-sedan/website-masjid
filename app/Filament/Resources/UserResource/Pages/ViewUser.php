<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions\Action as FilamentAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Password;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),

            FilamentAction::make('verifikasi_email')
                ->label('Verify Email')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->visible(fn () => $this->getRecord()->email_verified_at === null)
                ->action(fn () => $this->getRecord()->update(['email_verified_at' => now()]))
                ->requiresConfirmation(),

            FilamentAction::make('kirim_reset_password')
                ->label('Send Password Reset')
                ->icon('heroicon-o-key')
                ->color('info')
                ->visible(fn () => $this->getRecord()->google_id === null)
                ->action(function () {
                    Password::sendResetLink(['email' => $this->getRecord()->email]);
                })
                ->requiresConfirmation()
                ->modalDescription('A password reset link will be sent to: '.$this->getRecord()?->email),

            FilamentAction::make('reset_2fa')
                ->label('Reset 2FA')
                ->icon('heroicon-o-shield-exclamation')
                ->color('danger')
                ->visible(fn () => $this->getRecord()->two_factor_confirmed_at !== null)
                ->action(function () {
                    $this->getRecord()->update([
                        'two_factor_secret' => null,
                        'two_factor_recovery_codes' => null,
                        'two_factor_confirmed_at' => null,
                    ]);
                })
                ->requiresConfirmation()
                ->modalHeading('Reset Two-Factor Authentication')
                ->modalDescription('This will disable 2FA for this user. They will need to set it up again.'),

            DeleteAction::make(),
        ];
    }

    public function infolist(\Filament\Schemas\Schema $infolist): \Filament\Schemas\Schema
    {
        return $infolist
            ->schema([
                \Filament\Schemas\Components\Group::make()
                    ->schema([
                        \Filament\Infolists\Components\Section::make('Personal Information')
                            ->schema([
                                \Filament\Infolists\Components\TextEntry::make('name')
                                    ->label('Full Name'),

                                \Filament\Infolists\Components\TextEntry::make('email')
                                    ->label('Email Address')
                                    ->copyable(),

                                \Filament\Infolists\Components\TextEntry::make('google_id')
                                    ->label('Google ID')
                                    ->placeholder('Not connected')
                                    ->copyable(),

                                \Filament\Infolists\Components\TextEntry::make('created_at')
                                    ->label('Joined')
                                    ->dateTime('d M Y, H:i'),
                            ])
                            ->columns(2),

                        \Filament\Infolists\Components\Section::make('Articles')
                            ->schema([
                                \Filament\Infolists\Components\TextEntry::make('articles_count')
                                    ->label('Total Articles')
                                    ->state(fn (User $record) => $record->articles()->count()),

                                \Filament\Infolists\Components\TextEntry::make('published_articles_count')
                                    ->label('Published Articles')
                                    ->state(fn (User $record) => $record->articles()->where('status', 'published')->count()),

                                \Filament\Infolists\Components\TextEntry::make('draft_articles_count')
                                    ->label('Draft Articles')
                                    ->state(fn (User $record) => $record->articles()->where('status', 'draft')->count()),

                                \Filament\Infolists\Components\TextEntry::make('total_views')
                                    ->label('Total Article Views')
                                    ->state(fn (User $record) => number_format($record->articles()->sum('views'))),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(2),

                \Filament\Schemas\Components\Group::make()
                    ->schema([
                        \Filament\Infolists\Components\Section::make('Roles')
                            ->schema([
                                \Filament\Infolists\Components\TextEntry::make('roles.name')
                                    ->label('Assigned Roles')
                                    ->badge()
                                    ->color('primary')
                                    ->separator(', ')
                                    ->placeholder('No roles assigned'),
                            ]),

                        \Filament\Infolists\Components\Section::make('Account Status')
                            ->schema([
                                \Filament\Infolists\Components\IconEntry::make('email_verified_at')
                                    ->label('Email Verified')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-badge')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger'),

                                \Filament\Infolists\Components\TextEntry::make('email_verified_at')
                                    ->label('Verified At')
                                    ->dateTime('d M Y, H:i')
                                    ->placeholder('Not verified')
                                    ->visible(fn (User $record) => $record->email_verified_at !== null),

                                \Filament\Infolists\Components\IconEntry::make('two_factor_confirmed_at')
                                    ->label('Two-Factor Auth')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-shield-check')
                                    ->falseIcon('heroicon-o-shield-exclamation')
                                    ->trueColor('success')
                                    ->falseColor('gray'),

                                \Filament\Infolists\Components\TextEntry::make('two_factor_confirmed_at')
                                    ->label('2FA Active Since')
                                    ->dateTime('d M Y, H:i')
                                    ->placeholder('Not enabled')
                                    ->visible(fn (User $record) => $record->two_factor_confirmed_at !== null),
                            ]),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }
}
