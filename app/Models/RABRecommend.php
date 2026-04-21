<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RABRecommend extends Model
{
    public $timestamps = false;
    public static function recommend($luas){
        $rows = DB::table('recomend_ruang')
            ->where('luas_optimal', '<=', $luas)
            ->orderBy('luas_optimal', 'desc')
            ->get()
            ->toArray();

        return !empty($rows) ? $rows : false;
    }
}
