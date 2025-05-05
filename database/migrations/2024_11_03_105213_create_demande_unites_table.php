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
        Schema::create('demande_unites', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('unite_user_id')->constrained('unite_users')->onDelete('cascade');
            $table->foreignId('sender_uniter_id')->nullable()->constrained('unite_users')->onDelete('cascade');
            $table->float('sender_argent')->default(0);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_unites');
    }
};
