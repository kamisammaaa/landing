<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput, FileUpload, Select, RichEditor, Toggle, Hidden};
use Filament\Tables\Columns\{ImageColumn, TextColumn, IconColumn};
use Filament\Tables\Actions\{EditAction, DeleteAction, ViewAction, ActionGroup};
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 3;
    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Media')
                ->schema([
                    TextInput::make('judul')
                        ->required()
                        ->maxLength(150)
                        ->live()
                        ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),

                    TextInput::make('slug')
                        ->required()
                        ->unique('galleries', 'slug', ignoreRecord: true)
                        ->regex('/^[a-z0-9\-]+$/'),

                    Select::make('file_type')
                        ->options([
                            'image' => '🖼️ Gambar',
                            'video' => '🎥 Video',
                        ])
                        ->default('image')
                        ->required(),

                    Select::make('jurusan_id')
                        ->relationship('jurusan', 'nama')
                        ->searchable()
                        ->nullable(),
                ])->columns(2),

            Forms\Components\Section::make('Upload File')
                ->schema([
                    FileUpload::make('file_path')
                        ->directory('galleries')
                        ->maxSize(10240)
                        ->acceptedFileTypes(['image/*', 'video/mp4', 'video/webm'])
                        ->required(),
                ]),

            Forms\Components\Section::make('Detail')
                ->schema([
                    RichEditor::make('deskripsi')->nullable(),

                    Toggle::make('is_published')
                        ->default(true),

                    Hidden::make('uploaded_by')
                        ->default(fn () => auth()->id()),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('file_path')
                    ->label('Preview')
                    ->size(60)
                    ->circular(),

                TextColumn::make('judul')
                    ->searchable()
                    ->limit(25)
                    ->weight('bold'),

                TextColumn::make('file_type')
                    ->badge()
                    ->colors([
                        'info' => 'image',
                        'warning' => 'video',
                    ])
                    ->formatStateUsing(
                        fn (string $state) =>
                        $state === 'image' ? '🖼️ Gambar' : '🎥 Video'
                    ),

                TextColumn::make('jurusan.nama')
                    ->label('Jurusan')
                    ->default('Umum'),

                IconColumn::make('is_published')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([12, 24, 48, 100])
            ->searchable();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }

/**
 * @return Builder<Gallery>
 */
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->withoutGlobalScopes();
}

    public static function canViewAny(): bool { return true; }
    public static function canCreate(): bool { return true; }
    public static function canEdit(Model $record): bool { return true; }
    public static function canDelete(Model $record): bool { return true; }
}