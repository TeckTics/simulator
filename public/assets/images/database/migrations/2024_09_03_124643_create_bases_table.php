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
        Schema::create('bases', function (Blueprint $table) {
            $table->id();
            $table->string('nom_base');
            $table->string('icon_base')->nullable();
            $table->float('position_x');
            $table->text('description_base')->nullable();
            $table->float('position_y');
            $table->foreignId('type_base_id')->constrained('type_bases')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bases');
    }
};
