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
        Schema::create('parametre_jeu', function (Blueprint $table) {
            $table->id();
            $table->text('message_regulation')->nullable();
            $table->integer('distance_generation_mission')->default(20)->nullable();
            $table->text('message_fin_mission')->nullable();
            $table->string("nom_alliance")->default("Alliance SAMU")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametre_jeus');
    }
};
