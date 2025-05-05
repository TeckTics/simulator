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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('nom_mission');
            $table->text('description_mission');
            $table->time('duree');
            $table->boolean('published')->default(false);
            $table->foreignId('personnel_id')->constrained('personnels')->onDelete('cascade');
            $table->foreignId('type_unite_id')->constrained('type_unites')->onDelete('cascade');
            $table->float('recompense');
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
        Schema::dropIfExists('missions');
    }
};
