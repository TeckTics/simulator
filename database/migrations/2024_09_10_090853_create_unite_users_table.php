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
        Schema::create('unite_users', function (Blueprint $table) {
            $table->id();
            $table->float('vitesse');
            $table->string('nom');
            $table->integer('places_disponible');
            $table->enum('etat_mouvement_unite', ['en déplacement', 'en pause'])->nullable();
            $table->enum('etat_unite', ['a la base', 'en mission'])->nullable();
            $table->float('taux_usure');
            $table->integer('quantity')->default(1)->nullable();
            $table->json('capacites')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('unite_id')->constrained('unites')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unite_users');
    }
};
