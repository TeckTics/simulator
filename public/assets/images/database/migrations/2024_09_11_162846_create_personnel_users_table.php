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
        Schema::create('personnel_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personnel_id')->constrained('personnels')->onDelete('cascade');
            $table->enum('etat_mouvement_personnel', ['en déplacement', 'en pause'])->nullable();
            $table->enum('etat_formation_personnel', ['en formation', 'libre'])->nullable();
            $table->integer('quantite_personnel')->default(0);
            $table->integer('niveau')->default(1);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_users');
    }
};
