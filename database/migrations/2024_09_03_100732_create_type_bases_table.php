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
        Schema::create('type_bases', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('image');
            $table->text('description');
            $table->boolean('published')->default(false);
            $table->foreignId('admin_id')->index()->constrained('admins')->onDelete(action: 'CASCADE');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_bases');
    }
};
