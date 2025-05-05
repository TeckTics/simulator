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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string("titre_personnel");
            $table->text("description_personnel")->nullable();
            $table->float("prix_personnel")->default(0);
            $table->string("image");
            $table->boolean("published");
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
        Schema::dropIfExists('personnels');
    }
};
