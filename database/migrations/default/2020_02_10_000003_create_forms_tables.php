<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormsTables extends Migration
{
    public function up(): void
    {
        Schema::create('forms', static function (Blueprint $table): void {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);
        });

        Schema::create('form_translations', static function (Blueprint $table): void {
            createDefaultTranslationsTableFields($table, 'form');
            $table->string('title')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_translations');
        Schema::dropIfExists('forms');
    }
}
