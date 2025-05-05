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
        Schema::table('personnels', function (Blueprint $table) {
            $table->dropColumn('information');
        });
        Schema::create('personnel_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personnel_id')->constrained('personnels')->onDelete('cascade');
            $table->string('information');
            $table->timestamps();
        });

        Schema::create('personnel_user_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personnel_user_id')->constrained('personnel_users')->onDelete('cascade');
            $table->foreignId('personnel_information_id')->constrained('personnel_informations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
