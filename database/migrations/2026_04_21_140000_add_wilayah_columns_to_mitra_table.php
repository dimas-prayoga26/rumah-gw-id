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
        Schema::table('mitra', function (Blueprint $table) {
            if (!Schema::hasColumn('mitra', 'provinsi')) {
                $table->string('provinsi')->nullable()->after('lokasi');
            }

            if (!Schema::hasColumn('mitra', 'kabupaten_kota')) {
                $table->string('kabupaten_kota')->nullable()->after('provinsi');
            }

            if (!Schema::hasColumn('mitra', 'kecamatan')) {
                $table->string('kecamatan')->nullable()->after('kabupaten_kota');
            }

            if (!Schema::hasColumn('mitra', 'desa')) {
                $table->string('desa')->nullable()->after('kecamatan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('mitra', 'desa')) {
            Schema::table('mitra', function (Blueprint $table) {
                $table->dropColumn('desa');
            });
        }

        if (Schema::hasColumn('mitra', 'kecamatan')) {
            Schema::table('mitra', function (Blueprint $table) {
                $table->dropColumn('kecamatan');
            });
        }

        if (Schema::hasColumn('mitra', 'kabupaten_kota')) {
            Schema::table('mitra', function (Blueprint $table) {
                $table->dropColumn('kabupaten_kota');
            });
        }

        if (Schema::hasColumn('mitra', 'provinsi')) {
            Schema::table('mitra', function (Blueprint $table) {
                $table->dropColumn('provinsi');
            });
        }
    }
};
