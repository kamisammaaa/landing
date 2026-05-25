<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $fillable = [
        'judul',
        'slug',
        'file_path',
        'file_type',
        'deskripsi',
        'jurusan_id',
        'is_published',
        'uploaded_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'jurusan_id' => 'integer',
        'uploaded_by' => 'integer',
    ];

    /**
     * Auto isi uploader saat create
     */
    protected static function booted(): void
    {
        static::creating(function ($gallery): void {
            if (Auth::check()) {
                $gallery->uploaded_by = Auth::id();
            }
        });
    }

    /**
     * @return BelongsTo<\App\Models\Jurusan, self>
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * @return BelongsTo<\App\Models\User, self>
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}