<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'Pengaduan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_credentials_id',
        'title',
        'status' //in_progress atau closed
    ];

    public function pesanPengaduan(){
        return $this->hasMany(PesanPengaduan::class, 'pengaduan_id');
    }

    public function credentials(){
        return $this->belongsTo(UserCredentials::class, 'user_credentials_id', 'id');
    }
}
