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
        Schema::create('aptitudes', function (Blueprint $table) {
            $table->id();
            $table->string('intitule_aptitude');
            $table->string('description_aptitude');
            $table->string('slug_aptitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aptitudes');
    }
};
