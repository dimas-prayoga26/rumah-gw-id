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
            $table->string('nama');
            $table->string('email')->unique();
            $table->integer('is_mitra')->default(0)->comment('0 = user, 1 = mitra, 2 = admin');
            $table->string('password');
            $table->string('google_id')->nullable();
            $table->rememberToken();
        });

        Schema::create('mitra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->text('deskripsi')->nullable();
            $table->string('keahlian');
            $table->string('alamat_mitra');
            $table->string('lokasi')->nullable();
            $table->integer('harga')->nullable();
            $table->string('whatsapp');
            $table->string('foto_profil')->default('default.jpg');
            $table->string('portfolio')->nullable();
            $table->string('portfolio2')->nullable();
            $table->string('portfolio3')->nullable();
            $table->string('portfolio4')->nullable();
            $table->string('portfolio5')->nullable();
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
        Schema::dropIfExists('user');
        Schema::dropIfExists('perusahaan');
        Schema::dropIfExists('tukang');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
