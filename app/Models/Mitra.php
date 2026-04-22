<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'mitra';
    protected $with = ['user', 'promos'];

    protected $fillable = [
        'user_id',
        'deskripsi',
        'foto_profil',
        'whatsapp',
        'harga',
        'lokasi',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'desa',
        'keahlian',
        'alamat_mitra',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mitraNotification()
    {
        return $this->hasMany(MitraNotification::class, 'mitra_id', 'user_id');
    }

    public function promos()
    {
        return $this->hasMany(Promo::class, 'mitra_id', 'id');
    }

    public function imagePortofolios()
    {
        return $this->hasMany(ImagePortofolio::class, 'mitra_id', 'id');
    }
}
