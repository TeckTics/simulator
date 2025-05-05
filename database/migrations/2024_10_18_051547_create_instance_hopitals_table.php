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
        Schema::create('instance_hopitals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hopital_id')->constrained('hopitals')->onDelete('cascade');
            $table->interge('place');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instance_hopitals');
    }
};
