<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKomentar extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'userkomentar';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_credentials_id',
        'kelas_id',
        'komentartext',
        'rating',
        'status'
    ];

    public function credentials(){
        return $this->belongsTo(UserCredentials::class, 'user_credentials_id', 'id');
    }

    public function kelas(){
        return $this->belongsTo(kelas::class, 'kelas_id', 'id');
    }
}
