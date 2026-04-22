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
        $columns = ['portfolio', 'portfolio2', 'portfolio3', 'portfolio4', 'portfolio5'];
        $existingColumns = array_values(array_filter($columns, fn ($col) => Schema::hasColumn('mitra', $col)));

        if (!empty($existingColumns)) {
            Schema::table('mitra', function (Blueprint $table) use ($existingColumns) {
                $table->dropColumn($existingColumns);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mitra', function (Blueprint $table) {
            $table->string('portfolio')->nullable();
            $table->string('portfolio2')->nullable();
            $table->string('portfolio3')->nullable();
            $table->string('portfolio4')->nullable();
            $table->string('portfolio5')->nullable();
        });
    }
};
