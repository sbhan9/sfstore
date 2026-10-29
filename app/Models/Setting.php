<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    // Primary key menggunakan kolom key
    protected $primaryKey = 'key';

    // Primary key berupa string
    protected $keyType = 'string';

    // Tidak menggunakan auto increment
    public $incrementing = false;

    // Nonaktifkan created_at dan updated_at
    public $timestamps = false;

    protected $fillable = [
        'key',
        'value',
    ];

    public static function val(string $key, ?string $default = null): ?string
    {
        return static::query()->whereKey($key)->value('value') ?? $default;
    }
}
