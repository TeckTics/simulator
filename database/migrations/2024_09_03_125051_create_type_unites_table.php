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
        Schema::create('type_unites', function (Blueprint $table) {
            $table->id();
            $table->string('nom_type_unite');
            $table->text('description_type_unite');
            $table->string('image')->nullable();
            // $table->string('slug_type_unite');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_unites');
    }
};
