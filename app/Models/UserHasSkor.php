<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasSkor extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'userHasSkor';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_credentials_id',
        'skor'
    ];

    public function credentials(){
        return $this->belongsTo(UserCredentials::class, 'user_credentials_id', 'id');
    }
}
