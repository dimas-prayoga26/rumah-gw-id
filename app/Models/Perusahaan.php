<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    public $timestamps = false;
    protected $table = 'perusahaan';

    protected $fillable = [
        'user_id',
        'alamat_perusahaan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
