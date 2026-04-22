<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagePortofolio extends Model
{
    use HasFactory;

    protected $table = 'image_portofolio';

    protected $fillable = [
        'mitra_id',
        'mitra_image_portfolio',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }
}
