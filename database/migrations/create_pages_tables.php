<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTables extends Migration
{
    public function up(): void
    {
        Schema::create('pages', static function (Blueprint $table): void {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            $table->integer('position')->unsigned()->nullable();

            // enable publication timeframe fields
            $table->timestamp('publish_start_date')->nullable();
            $table->timestamp('publish_end_date')->nullable();

            $table->nestedSet();
        });

        Schema::create('page_translations', static function (Blueprint $table): void {
            createDefaultTranslationsTableFields($table, 'page');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('page_slugs', static function (Blueprint $table): void {
            createDefaultSlugsTableFields($table, 'page');
        });

        Schema::create('page_revisions', static function (Blueprint $table): void {
            createDefaultRevisionsTableFields($table, 'page');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_revisions');
        Schema::dropIfExists('page_translations');
        Schema::dropIfExists('page_slugs');
        Schema::dropIfExists('pages');
    }
}
