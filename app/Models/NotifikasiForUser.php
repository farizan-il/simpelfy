<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifikasiForUser extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'NotifikasiForUser';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_credentials_id',
        'kalimat'
    ];

    public function credentials(){
        return $this->belongsTo(UserCredentials::class, 'user_credentials_id', 'id');
    }
}
