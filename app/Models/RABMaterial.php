<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RABMaterial extends Model
{
    protected $table = 'material';
    public $timestamps = false;

    protected $fillable = [
        'kategori',
        'nama',
        'harga',
        'rasio',
        'item'
    ];
    public static function Material($data){
        $row = DB::table("material")->where("kategori", $data["kategori"])->where("item", $data["item"])->first();

        return !empty($row) ? $row : false;
    }
}
