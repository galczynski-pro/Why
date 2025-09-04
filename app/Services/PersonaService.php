<?php

namespace App\Services;

use App\Models\Persona;
use Illuminate\Support\Facades\Cache;
use Throwable;

class PersonaService
{
    public function getActive(string $key): ?array
    {
        $cacheKey = "persona.active.".$key;
        try {
            return Cache::remember($cacheKey, 3600, function () use ($key) {
                return $this->fetch($key);
            });
        } catch (Throwable) {
            // Fallback if cache store is misconfigured
            return $this->fetch($key);
        }
    }

    private function fetch(string $key): ?array
    {
        $row = Persona::query()
            ->where('key', $key)
            ->where('is_active', true)
            ->first();

        if (!$row) {
            return null;
        }

        return [
            'key' => $row->key,
            'name' => $row->name,
            'type' => $row->type,
            'version' => $row->version,
            'last_updated' => optional($row->last_updated)->toDateString(),
            'data' => $row->data,
            'updated_at' => optional($row->updated_at)->toDateTimeString(),
        ];
    }
}
