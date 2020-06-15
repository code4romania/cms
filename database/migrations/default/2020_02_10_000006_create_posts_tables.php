<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTables extends Migration
{
    public function up()
    {
        Schema::create('posts', static function (Blueprint $table): void {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            $table->integer('position')->unsigned()->nullable();

            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            $table->timestamp('publish_start_date')->nullable();
            $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('post_translations', static function (Blueprint $table): void {
            createDefaultTranslationsTableFields($table, 'post');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('post_slugs', static function (Blueprint $table): void {
            createDefaultSlugsTableFields($table, 'post');
        });

        Schema::create('post_revisions', static function (Blueprint $table): void {
            createDefaultRevisionsTableFields($table, 'post');
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_revisions');
        Schema::dropIfExists('post_translations');
        Schema::dropIfExists('post_slugs');
        Schema::dropIfExists('posts');
    }
}
