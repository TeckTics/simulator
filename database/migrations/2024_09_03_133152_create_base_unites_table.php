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
        Schema::create('base_unites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('base_id')->constrained('bases')->onDelete('cascade');
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
        Schema::dropIfExists('base_unites');
    }
};
