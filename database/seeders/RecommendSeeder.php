<?php

namespace Database\Seeders;

use App\Models\RecommendRuang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecommendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecommendRuang::create([
            'type' => 1,
            'teras' => 3.04,
            'r_tamu' => 7.23,
            'r_keluarga' => 12.3,
            'k_tidur_utama' => 8.84,
            'k_tidur' => 5.6,
            'dapur' => 4.6,
            'k_mandi' => 2.05,
            'r_cuci' => 3.8,
            'balkon' => 4.5,
            'tangga' => 8,
            'luas_optimal' => 47,
        ]);

        RecommendRuang::create([
            'type' => 2,
            'teras' => 4.4,
            'r_tamu' => 9.5,
            'r_keluarga' => 16,
            'k_tidur_utama' => 12,
            'k_tidur' => 10.5,
            'dapur' => 6,
            'k_mandi' => 5,
            'r_cuci' => 6,
            'balkon' => 4.5,
            'tangga' => 8,
            'luas_optimal' => 69,
        ]);

        RecommendRuang::create([
            'type' => 3,
            'teras' => 6.4,
            'r_tamu' => 12.5,
            'r_keluarga' => 20,
            'k_tidur_utama' => 18,
            'k_tidur' => 10.5,
            'dapur' => 9,
            'k_mandi' => 7.5,
            'r_cuci' => 9,
            'balkon' => 4.5,
            'tangga' => 8,
            'luas_optimal' => 92,
        ]);

        RecommendRuang::create([
            'type' => 0,
            'teras' => 3.04,
            'r_tamu' => 7,
            'r_keluarga' => 9,
            'k_tidur_utama' => 6,
            'k_tidur' => 5.6,
            'dapur' => 3.5,
            'k_mandi' => 2.05,
            'r_cuci' => 0,
            'balkon' => 0,
            'tangga' => 0,
            'luas_optimal' => 36,
        ]);
    }
}
