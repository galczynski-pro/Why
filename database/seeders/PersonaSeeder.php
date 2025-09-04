<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{
    public function run(): void
    {
        $path = base_path('why.json');
        if (!file_exists($path)) {
            $this->command?->warn('why.json not found; skipping persona seed.');
            return;
        }

        $raw = json_decode(file_get_contents($path), true);
        if (!is_array($raw)) {
            $this->command?->warn('why.json invalid JSON; skipping persona seed.');
            return;
        }

        $meta = $raw['persona_meta_instruction'] ?? [];

        $name = $meta['persona_name'] ?? 'Why';
        $type = $meta['persona_type'] ?? null;
        $version = $meta['version'] ?? null;
        $lastUpdated = $meta['last_updated'] ?? null;

        // Store the full file structure (wrapper included) to match current DB contents
        $dataJson = json_encode($raw, JSON_UNESCAPED_UNICODE);

        DB::table('personas')->updateOrInsert(
            ['key' => 'why'],
            [
                'name' => $name,
                'type' => $type,
                'version' => $version,
                'last_updated' => $lastUpdated,
                'is_active' => 1,
                'data' => $dataJson,
                'updated_by' => null,
                'updated_at' => now(),
                'created_at' => DB::raw('COALESCE(created_at, NOW())'),
            ]
        );
    }
}

