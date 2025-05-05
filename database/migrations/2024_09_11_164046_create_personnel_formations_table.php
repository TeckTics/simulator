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
        Schema::create('personnel_formations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personnel_user_id')->constrained('personnel_users')->onDelete('cascade');
            $table->time('date_fin_formation');
            $table->foreignId('formation_id')->constrained('formations')->onDelete('cascade');
            $table->id('next_formation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_formations');
    }
};
