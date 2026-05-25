<?php

namespace App\Filament\Admin\Resources\SettingResource\Pages;

use App\Filament\Admin\Resources\SettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    /**
     * Menentukan aksi tombol di bagian atas tabel (Header Actions)
     */
    protected function getHeaderActions(): array
    {
        return [
            // Kosong karena canCreate() sudah kita set ke false di Resource
        ];
    }
}