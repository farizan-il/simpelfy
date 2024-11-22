<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'UserPreference';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_credentials_id',
        'kategori_id'
    ];

    public function credentials(){
        return $this->belongsTo(UserCredentials::class, 'user_credentials_id', 'id');
    }

    public function kategori(){
        return $this->belongsTo(KategoriKelas::class, 'kategori_id', 'id');
    }
}