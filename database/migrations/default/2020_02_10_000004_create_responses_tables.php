<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResponsesTables extends Migration
{
    public function up(): void
    {
        Schema::create('responses', static function (Blueprint $table): void {
            // this will create an id and soft delete and timestamps columns
            createDefaultTableFields($table, true, false);
            $table->json('data')->nullable();
            $table->foreignId('form_id')->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
}
