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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('nom_event');
            $table->text('description_event');
            $table->enum('type_event', ['solo', 'multi']);
            $table->date('date_fin');
            $table->float('recompense');
            $table->boolean('published')->nullable();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
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
        Schema::dropIfExists('events');
    }
};
