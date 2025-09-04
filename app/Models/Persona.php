<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'key', 'name', 'type', 'version', 'last_updated', 'is_active', 'data', 'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_updated' => 'date',
        'data' => 'array',
    ];
}

