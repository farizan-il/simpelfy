<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'keranjang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_credentials_id',
        'kelas_id'
    ];

    public function credentials(){
        return $this->belongsTo(UserCredentials::class, 'user_credentials_id', 'id');
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}
