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
        Schema::create('recomend_ruang', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->comment('0 = biasa, 1 = sederhana, 2 = menengah, 3 = mewah');
            $table->float('teras');
            $table->float('r_tamu');
            $table->float('r_keluarga');
            $table->float('k_tidur_utama');
            $table->float('k_tidur');
            $table->float('dapur');
            $table->float('k_mandi');
            $table->float('r_cuci');
            $table->float('balkon');
            $table->float('tangga');
            $table->float('luas_optimal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recomend_ruang');
    }
};
