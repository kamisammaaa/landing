<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'isi',
        'tipe',
        'is_active',
        'mulai_tampil',
        'selesai_tampil',
        'target_url',
        'urutan',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'mulai_tampil' => 'datetime',
        'selesai_tampil' => 'datetime',
        'urutan' => 'integer',
    ];

    /**
     * Scope: Hanya yang aktif & dalam jadwal tayang
     *
     * @param Builder<\App\Models\Announcement> $query
     * @return Builder<\App\Models\Announcement>
     */
    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(function (Builder $q): void {
                $q->whereNull('mulai_tampil')
                    ->orWhere('mulai_tampil', '<=', now());
            })
            ->where(function (Builder $q): void {
                $q->whereNull('selesai_tampil')
                    ->orWhere('selesai_tampil', '>=', now());
            })
            ->orderBy('urutan');
    }

    /**
     * Helper: Cek apakah masih aktif
     */
    public function isCurrentlyActive(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->mulai_tampil && $this->mulai_tampil->isFuture()) {
            return false;
        }

        if ($this->selesai_tampil && $this->selesai_tampil->isPast()) {
            return false;
        }

        return true;
    }
}