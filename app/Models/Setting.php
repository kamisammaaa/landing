<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'key',
        'group',
        'value',
        'type',
        'description',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Helper: Get setting value by key (dengan cache)
     */
    public static function get(string $key, string $default = ''): string
    {
        return Cache::remember(
            "setting_{$key}",
            3600,
            function () use ($key, $default): string {
                return static::where('key', $key)
                    ->where('is_active', true)
                    ->value('value') ?? $default;
            }
        );
    }
}
