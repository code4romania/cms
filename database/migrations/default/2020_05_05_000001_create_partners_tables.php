<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartnersTables extends Migration
{
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            $table->string('name', 200)->nullable();
            $table->string('website', 100)->nullable();

            $table->integer('position')->unsigned()->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('partners');
    }
}
