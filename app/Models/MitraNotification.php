<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraNotification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'title',
        'message',
        'user_id',
        'mitra_id'
    ];

     // USER yang mengirim notif
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // MITRA penerima notif (juga user)
    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }

}
