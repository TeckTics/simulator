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
        if (!Schema::hasTable('equipements')) {
            Schema::create('equipements', function (Blueprint $table) {
                $table->id();
                $table->foreignId('type_unite_id')->constrained()->onDelete('cascade');
                $table->string('nom_equipement');
                $table->text('description_equipement')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipements');
    }
};
