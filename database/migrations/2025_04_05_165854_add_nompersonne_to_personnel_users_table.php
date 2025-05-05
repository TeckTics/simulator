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
        Schema::table('personnel_users', function (Blueprint $table) {
            $table->string('prenom_personnel')->nullable()->after('deleted_at');
        });
        Schema::table('personnels', function (Blueprint $table) {
            $table->json('information')->nullable()->after('niveau');
        });
    }
    
    public function down(): void
    {
        Schema::table('personnel_users', function (Blueprint $table) {
            $table->dropColumn('nom_personnel');
        });
    }
};
