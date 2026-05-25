<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar_cover',
        'kategori',
        'status',
        'published_at',
        'is_featured',
        'views',
        'author_id',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'views' => 'integer',
        'published_at' => 'datetime',
    ];

    /**
     * @return BelongsTo<\App\Models\User, self>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}