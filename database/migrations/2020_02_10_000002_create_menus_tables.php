<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTables extends Migration
{
    public function up(): void
    {
        Schema::create('menus', static function (Blueprint $table): void {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);
            $table->string('location')->nullable();
        });

        Schema::create('menu_translations', static function (Blueprint $table): void {
            createDefaultTranslationsTableFields($table, 'menu');
            $table->string('title')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_translations');
        Schema::dropIfExists('menus');
    }
}
