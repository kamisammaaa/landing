<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput, RichEditor, FileUpload, Select, DateTimePicker, Toggle, Hidden, Section};
use Filament\Tables\Columns\{TextColumn, IconColumn};
use Filament\Tables\Actions\{EditAction, DeleteAction, ViewAction, ActionGroup};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Section::make('Informasi Utama')->schema([
                TextInput::make('judul')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $state, Set $set) =>
                        $set('slug', Str::slug($state))
                    ),

                TextInput::make('slug')
                    ->required()
                    ->unique(table: 'posts', column: 'slug', ignoreRecord: true)
                    ->regex('/^[a-z0-9\-]+$/'),

                Select::make('kategori')
                    ->options([
                        'akademik' => 'Akademik',
                        'ekstrakurikuler' => 'Ekstrakurikuler',
                        'prestasi' => 'Prestasi',
                        'pengumuman' => 'Pengumuman',
                    ])
                    ->required(),
            ])->columns(2),

            Section::make('Konten')->schema([
                RichEditor::make('konten')
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('gambar_cover')
                    ->image()
                    ->directory('posts')
                    ->maxSize(2048),
            ]),

            Section::make('Publikasi')->schema([
                DateTimePicker::make('published_at')
                    ->default(now())
                    ->required(),

                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft'),

                Toggle::make('is_featured')->default(false),

                Hidden::make('author_id')
                    ->default(fn (): ?int => auth()->id()),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->searchable()
                    ->limit(30)
                    ->weight('bold'),

                TextColumn::make('kategori')
                    ->badge()
                    ->colors([
                        'info' => 'akademik',
                        'warning' => 'ekstrakurikuler',
                        'success' => 'prestasi',
                        'danger' => 'pengumuman',
                    ]),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'gray' => 'draft',
                        'success' => 'published',
                    ]),

                IconColumn::make('is_featured')->boolean(),

                TextColumn::make('published_at')
                    ->dateTime('d M Y')
                    ->sortable(),

                TextColumn::make('views')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('author.name')
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori'),
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\TernaryFilter::make('is_featured'),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool { return true; }
    public static function canCreate(): bool { return true; }
    public static function canEdit(Model $record): bool { return true; }
    public static function canDelete(Model $record): bool { return true; }
    public static function canView(Model $record): bool { return true; }
}