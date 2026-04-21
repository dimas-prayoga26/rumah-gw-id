<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    /** @use HasFactory<\Database\Factories\PromoFactory> */
    use HasFactory;

    protected $fillable = [
        'mitra_id',
        'judul',
        'diskon',
        'harga_akhir',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }

    public function scopeSort($query)
    {
        return $query
            ->where('mitra_id', auth()->user()->id)
            ->orderByRaw("
                CASE
                    WHEN CURDATE() BETWEEN tanggal_mulai AND tanggal_selesai THEN 1
                    WHEN CURDATE() < tanggal_mulai THEN 2
                    ELSE 3
                END
            ")
            ->orderByDesc('created_at');
    }
}
