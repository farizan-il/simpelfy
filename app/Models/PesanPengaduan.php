<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanPengaduan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'PesanPengaduan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'pengaduan_id',
        'user_credentials_id',
        'sender_type', //admin dan user
        'message',
        'file',
        'sent_at'
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function credentials()
    {
        return $this->belongsTo(UserCredentials::class, 'user_credentials_id', 'id');
    }

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'id');
    }
}

