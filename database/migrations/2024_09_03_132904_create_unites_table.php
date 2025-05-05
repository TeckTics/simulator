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
        Schema::create('unites', function (Blueprint $table) {
            $table->id();
            $table->string('vitesse_unite');
            $table->string('nom_unite');
            $table->integer('capacite_unite');
            $table->enum('etat_mouvement_unite', ['en déplacement', 'en pause']);
            $table->enum('etat_unite', ['a la base', 'en mission']);
            $table->float('taux_usure');
            $table->float('prix_unite');
            $table->foreignId('type_unite_id')->constrained('type_unites')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unites');
    }
};
