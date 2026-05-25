<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PortalLinkResource\Pages;
use App\Models\PortalLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput, RichEditor, Select, Toggle, Section};
use Filament\Tables\Columns\{TextColumn, IconColumn};
use Filament\Tables\Actions\{EditAction, DeleteAction, ViewAction, ActionGroup};
use Illuminate\Database\Eloquent\Model;

class PortalLinkResource extends Resource
{
    protected static ?string $model = PortalLink::class;
    protected static ?string $navigationIcon = 'heroicon-o-link';
    protected static ?string $navigationGroup = 'Integrasi Sistem';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informasi Portal')->schema([
                TextInput::make('nama')
                    ->required()
                    ->maxLength(50),

                TextInput::make('url')
                    ->required()
                    ->url()
                    ->maxLength(255),
            ])->columns(2),

            Section::make('Status & Tampilan')->schema([
                Select::make('status')
                    ->options([
                        'active' => 'Aktif',
                        'maintenance' => 'Maintenance',
                        'offline' => 'Offline',
                    ])
                    ->default('active'),

                Toggle::make('is_visible')->default(true),

                TextInput::make('urutan')
                    ->numeric()
                    ->default(0),

                TextInput::make('icon')
                    ->placeholder('heroicon-o-globe'),
            ])->columns(2),

            Section::make('Deskripsi')->schema([
                RichEditor::make('deskripsi')
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('url')
                    ->limit(30)
                    ->tooltip(fn (PortalLink $record): string => (string) $record->url)
                    ->copyable(),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'success' => 'active',
                        'warning' => 'maintenance',
                        'danger' => 'offline',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'Aktif',
                        'maintenance' => 'Maintenance',
                        'offline' => 'Offline',
                        default => $state,
                    }),

                IconColumn::make('is_visible')->boolean(),

                TextColumn::make('click_count')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\TernaryFilter::make('is_visible'),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),

                    Tables\Actions\Action::make('open')
                        ->label('Buka')
                        ->icon('heroicon-m-arrow-top-right-on-square')
                        ->url(fn (PortalLink $record): string => (string) $record->url)
                        ->openUrlInNewTab(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('urutan', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortalLinks::route('/'),
            'create' => Pages\CreatePortalLink::route('/create'),
            'edit' => Pages\EditPortalLink::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool { return true; }
    public static function canCreate(): bool { return true; }
    public static function canEdit(Model $record): bool { return true; }
    public static function canDelete(Model $record): bool { return true; }
}