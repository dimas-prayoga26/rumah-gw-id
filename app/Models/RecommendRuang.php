<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecommendRuang extends Model
{
    protected $table = 'recomend_ruang';

    protected $fillable = [
        'type',
        'teras',
        'r_tamu',
        'r_keluarga',
        'k_tidur_utama',
        'k_tidur',
        'dapur',
        'k_mandi',
        'r_cuci',
        'balkon',
        'tangga',
        'luas_optimal',
    ];
}
