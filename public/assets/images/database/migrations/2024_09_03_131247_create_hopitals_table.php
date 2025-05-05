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
        Schema::create('hopitals', function (Blueprint $table) {
            $table->id();
            $table->string('nom_hopital');
            $table->integer('capacite_hopital');
            $table->float('position_x');
            $table->float('position_y');
            $table->string('icon_hopital');
            $table->string('image_hopital')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hopitals');
    }
};
