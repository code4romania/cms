<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeopleTables extends Migration
{
    public function up()
    {
        Schema::create('people', static function (Blueprint $table): void {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            $table->string('name', 200);
            $table->string('linkedin', 200)->nullable();
            $table->string('github', 200)->nullable();
        });

        Schema::create('person_translations', static function (Blueprint $table): void {
            createDefaultTranslationsTableFields($table, 'person');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('personables', function (Blueprint $table) {
            $table->increments('id');
            $table->{twillIntegerMethod()}('position')->unsigned()->nullable();
            $table->{twillIntegerMethod()}('personable_id')->nullable()->unsigned();
            $table->string('personable_type')->nullable();
            $table->{twillIntegerMethod()}('person_id')->unsigned();
            $table->foreign('person_id', 'fk_personables_person_id')->references('id')->on('people')->onDelete('cascade')->onUpdate('cascade');
            $table->index(['personable_type', 'personable_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('personables');
        Schema::dropIfExists('person_translations');
        Schema::dropIfExists('people');
    }
}
