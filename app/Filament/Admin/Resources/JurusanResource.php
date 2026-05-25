<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JurusanResource\Pages;
use App\Models\Jurusan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput, RichEditor, Toggle, TagsInput, FileUpload, Select, Section};
use Filament\Tables\Columns\{TextColumn, IconColumn};
use Filament\Tables\Actions\{EditAction, DeleteAction, BulkActionGroup, DeleteBulkAction};
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class JurusanResource extends Resource
{
    protected static ?string $model = Jurusan::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informasi Dasar')
                ->description('Kode, nama, dan pengaturan tampilan jurusan')
                ->schema([
                    Select::make('kode')
                        ->options([
                            'TJKT' => 'TJKT - Teknik Jaringan Komputer dan Telekomunikasi',
                            'TKR'  => 'TKR - Teknik Kendaraan Ringan',
                            'TAV'  => 'TAV - Teknik Audio Video',
                        ])
                        ->required()
                        ->unique(table: 'jurusans', column: 'kode', ignoreRecord: true)
                        ->live()
                        ->afterStateUpdated(function (?string $state, Forms\Set $set): void {
                            if ($state) {
                                $set('nama', self::getNamaFromKode($state));
                                $set('slug', Str::slug(self::getNamaFromKode($state)));
                            }
                        }),

                    TextInput::make('nama')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Forms\Set $set) =>
                            $set('slug', Str::slug($state ?? ''))
                        ),

                    TextInput::make('slug')
                        ->required()
                        ->unique(table: 'jurusans', column: 'slug', ignoreRecord: true)
                        ->regex('/^[a-z0-9\-]+$/'),

                    Toggle::make('is_active')->default(true),

                    TextInput::make('urutan')
                        ->numeric()
                        ->default(0),
                ])
                ->columns(2),

            Section::make('Deskripsi')
                ->schema([
                    RichEditor::make('deskripsi')
                        ->required()
                        ->columnSpanFull(),

                    TagsInput::make('fasilitas'),
                    TagsInput::make('prospek_kerja'),
                    TagsInput::make('kurikulum_unggulan'),
                ]),

            Section::make('Gambar')
                ->schema([
                    FileUpload::make('gambar')
                        ->image()
                        ->directory('jurusans')
                        ->maxSize(2048),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode')
                    ->badge(),

                TextColumn::make('nama')
                    ->searchable()
                    ->limit(40),

                IconColumn::make('is_active')
                    ->boolean(),

                TextColumn::make('urutan')->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_active'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()->requiresConfirmation(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('urutan');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJurusan::route('/'),
            'create' => Pages\CreateJurusan::route('/create'),
            'edit' => Pages\EditJurusan::route('/{record}/edit'),
        ];
    }

    protected static function getNamaFromKode(?string $kode): string
    {
        return match ($kode) {
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TKR'  => 'Teknik Kendaraan Ringan',
            'TAV'  => 'Teknik Audio Video',
            default => '',
        };
    }

    public static function canViewAny(): bool { return true; }
    public static function canCreate(): bool { return true; }
    public static function canEdit(Model $record): bool { return true; }
    public static function canDelete(Model $record): bool { return true; }
}
