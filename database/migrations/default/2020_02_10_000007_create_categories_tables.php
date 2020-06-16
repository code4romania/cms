<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTables extends Migration
{
    public function up()
    {
        Schema::create('categories', static function (Blueprint $table): void {
            // this will create an id and soft delete and timestamps columns
            createDefaultTableFields($table, true, false);
        });

        Schema::create('category_translations', static function (Blueprint $table): void {
            createDefaultTranslationsTableFields($table, 'category');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('category_slugs', static function (Blueprint $table): void {
            createDefaultSlugsTableFields($table, 'category');
        });

        Schema::create('category_post', static function (Blueprint $table): void {
            $table->{twillIncrementsMethod()}('id');
            $table->integer('position')->unsigned()->nullable();
            createDefaultRelationshipTableFields($table, 'category', 'post');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_post');
        Schema::dropIfExists('category_translations');
        Schema::dropIfExists('category_slugs');
        Schema::dropIfExists('categories');
    }
}
