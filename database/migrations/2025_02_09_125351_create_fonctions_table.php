<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('fonctions')){
        Schema::create('fonctions', function (Blueprint $table) {
            $table->id();
            $table->string('libelle_fonction');
            $table->text('description_fonction')->nullable();
            $table->boolean('fonction_requise')->default(false);
            $table->boolean('published')->default(false);
            $table->timestamps();
    });}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fonctions');
    }
};
