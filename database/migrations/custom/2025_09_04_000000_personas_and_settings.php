<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // personas
        if (!Schema::hasTable('personas')) {
            Schema::create('personas', function (Blueprint $table) {
                $table->id();
                $table->string('key', 64)->unique();
                $table->string('name', 120);
                $table->string('type', 120)->nullable();
                $table->string('version', 20)->nullable();
                $table->date('last_updated')->nullable();
                $table->boolean('is_active')->default(true);
                $table->json('data');
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->timestamps();
                $table->index('is_active', 'idx_personas_active');
            });
        }

        // persona_revisions
        if (!Schema::hasTable('persona_revisions')) {
            Schema::create('persona_revisions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('persona_id');
                $table->integer('version');
                $table->json('data');
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->unique(['persona_id', 'version'], 'uq_persona_version');
            });
        }

        // app_settings (single row id=1)
        if (!Schema::hasTable('app_settings')) {
            Schema::create('app_settings', function (Blueprint $table) {
                $table->unsignedTinyInteger('id')->primary();
                $table->string('site_name', 120)->default('iFairy');
                $table->string('url', 255)->nullable();
                $table->string('timezone', 64)->default('UTC');
                $table->string('locale', 10)->default('en');
                $table->json('flags')->nullable();
                $table->json('data')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // Non-destructive by default; drop tables only if needed
        // Schema::dropIfExists('persona_revisions');
        // Schema::dropIfExists('personas');
        // Schema::dropIfExists('app_settings');
    }
};

