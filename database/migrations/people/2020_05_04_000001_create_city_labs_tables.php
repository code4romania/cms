<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCityLabsTables extends Migration
{
    public function up()
    {
        Schema::create('city_labs', static function (Blueprint $table): void {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);
        });

        Schema::create('city_lab_translations', static function (Blueprint $table): void {
            createDefaultTranslationsTableFields($table, 'city_lab');
            $table->string('name', 200)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('city_lab_slugs', static function (Blueprint $table): void {
            createDefaultSlugsTableFields($table, 'city_lab');
        });
    }

    public function down()
    {
        Schema::dropIfExists('city_lab_translations');
        Schema::dropIfExists('city_lab_slugs');
        Schema::dropIfExists('city_labs');
    }
}
