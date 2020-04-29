<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTables extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', static function (Blueprint $table): void {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            $table->string('location', 200);
            $table->integer('position')->unsigned()->nullable();
            $table->string('type', 200)->nullable();
            $table->string('target', 200)->nullable();
            $table->nestedSet();
        });

        Schema::create('menu_item_translations', static function (Blueprint $table): void {
            createDefaultTranslationsTableFields($table, 'menu_item');
            $table->string('label', 200)->nullable();
            $table->text('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_item_translations');
        Schema::dropIfExists('menu_items');
    }
}
