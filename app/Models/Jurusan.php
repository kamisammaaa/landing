<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Jurusan extends Model
{
    use SoftDeletes;

    protected $table = 'jurusans';

    protected $fillable = [
        'kode',
        'nama',
        'slug',
        'deskripsi',
        'gambar',
        'fasilitas',
        'prospek_kerja',
        'kurikulum_unggulan',
        'urutan',
        'is_active',
        'views',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'views' => 'integer',
        'fasilitas' => 'array',
        'prospek_kerja' => 'array',
        'kurikulum_unggulan' => 'array',
        'deleted_at' => 'datetime',
    ];

    /**
     * @return Attribute<array<int, string>, mixed>
     */
    protected function fasilitasArray(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes): array =>
                $this->parseLegacyArray($attributes['fasilitas'] ?? null),
        );
    }

    /**
     * @return Attribute<array<int, string>, mixed>
     */
    protected function prospekKerjaArray(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes): array =>
                $this->parseLegacyArray($attributes['prospek_kerja'] ?? null),
        );
    }

    /**
     * @return Attribute<array<int, string>, mixed>
     */
    protected function kurikulumUnggulanArray(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes): array =>
                $this->parseLegacyArray($attributes['kurikulum_unggulan'] ?? null),
        );
    }

    /**
     * Helper: Parse string atau JSON menjadi array
     *
     * @param mixed $value
     * @return array<int, string>
     */
    protected function parseLegacyArray(mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if (empty($value)) {
            return [];
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);

            if (is_array($decoded)) {
                return $decoded;
            }

            $cleaned = str_replace(['"', "'"], '', $value);

            return array_values(array_filter(
                array_map('trim', explode(',', $cleaned)),
                fn ($item): bool => $item !== ''
            ));
        }

        return [];
    }
}