<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\{
    TextInput,
    Textarea,
    FileUpload,
    Section,
    Toggle,
    RichEditor
};
use Filament\Tables\Columns\{
    TextColumn,
    IconColumn
};
use Filament\Tables\Actions\EditAction;
use Illuminate\Database\Eloquent\Model;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Konfigurasi';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Pengaturan Situs';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informasi Setting')
                ->schema([
                    TextInput::make('key')
                        ->label('Key')
                        ->disabled()
                        ->dehydrated(true) // ✅ Wajib agar data terkirim saat submit
                        ->helperText('Key sistem tidak dapat diubah'),

                    TextInput::make('group')
                        ->label('Group')
                        ->disabled()
                        ->dehydrated(true),

                    TextInput::make('type')
                        ->label('Tipe Input')
                        ->disabled()
                        ->dehydrated(true), // ✅ Wajib agar logic visible bisa membaca tipe

                    Toggle::make('is_active')
                        ->label('Status Aktif')
                        ->required(),

                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->disabled()
                        ->dehydrated(true)
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Nilai Setting')
                ->schema([
                    // ✅ 1. FIELD IMAGE UPLOAD
                    FileUpload::make('value')
                        ->label('Upload Gambar')
                        ->image()
                        ->directory('settings')
                        ->disk('public')          // ✅ Simpan di disk 'public'
                        ->visibility('public')    // ✅ Agar bisa diakses via URL publik
                        ->maxSize(2048)
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('1:1')
                        ->visible(fn ($record) => $record?->type === 'image'),

                    // ✅ 2. FIELD TEXTAREA
                    Textarea::make('value')
                        ->label('Nilai')
                        ->rows(5)
                        ->visible(fn ($record) => $record?->type === 'textarea'),

                    // ✅ 3. FIELD RICH EDITOR
                    RichEditor::make('value')
                        ->label('Konten')
                        ->toolbarButtons([
                            'bold', 'italic', 'underline',
                            'bulletList', 'orderedList',
                        ])
                        ->visible(fn ($record) => $record?->type === 'richeditor'),

                    // ✅ 4. FIELD DEFAULT (TEXT INPUT)
                    TextInput::make('value')
                        ->label('Nilai')
                        ->visible(fn ($record) => 
                            !in_array($record?->type, ['image', 'textarea', 'richeditor'])
                        ),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'general' => 'primary',
                        'contact' => 'success',
                        'social' => 'info',
                        'seo' => 'warning',
                        'branding' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('key')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('value')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->value),

                IconColumn::make('is_active')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('group')
                    ->options([
                        'general' => 'General',
                        'contact' => 'Contact',
                        'social' => 'Social Media',
                        'seo' => 'SEO',
                        'branding' => 'Branding',
                    ]),

                \Filament\Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status'),
            ])
            ->actions([
                EditAction::make()
                    ->label('Edit')
                    ->iconButton()
                    ->tooltip('Edit Setting'),
            ])
            ->bulkActions([])
            ->defaultSort('group')
            ->paginated([25, 50, 100]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            // ✅ TAMBAHKAN ROUTE EDIT AGAR TOMBOL EDIT BERFUNGSI
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
