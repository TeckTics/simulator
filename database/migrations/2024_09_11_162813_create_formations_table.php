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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('libelle_formation');
            $table->float('prix_formation');
            $table->time('temps_formation');
            $table->string('image_formation');
            $table->integer('recompense_formation');
            $table->boolean('published');
            $table->foreignId('fonction_id')->constrained('fonctions')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
