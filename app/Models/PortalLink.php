<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortalLink extends Model
{
    use HasFactory;

    protected $table = 'portal_links';

    protected $fillable = [
        'nama',
        'url',
        'icon',
        'deskripsi',
        'status',
        'is_visible',
        'urutan',
        'click_count',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'click_count' => 'integer',
        'urutan' => 'integer',
    ];
}