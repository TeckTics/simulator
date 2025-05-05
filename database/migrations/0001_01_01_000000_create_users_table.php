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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('pseudo');
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->integer('niveau')->default(0);
            $table->float('experience')->default(0);
            $table->string('profile')->nullable();
            $table->float('argent')->default(300000);
            $table->float('perfomance')->default(0);
            $table->integer('isblocked')->default(0);
            $table->string('email')->unique();
            $table->foreignId('clan_id')-> nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_verified')->default(false);
            $table->boolean("sound_effect")->default(false);
            $table->boolean("trajet_unite_map")->default(false);
            $table->boolean("nom_mission_map")->default(false);
            $table->boolean("temp_mission")->default(false);
            $table->boolean('online')->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
