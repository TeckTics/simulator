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
        Schema::create('parametre_generals', function (Blueprint $table) {
            $table->id();
            $table->string("nom_app")->default("URGENCESAMU");
            $table->text('title_header_home_page');
            $table->foreignId('template_home_id')->constrained('template_homes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametre_generals');
    }
};
