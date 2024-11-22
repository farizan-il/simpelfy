<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserActivity extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'user_activity';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_credentials_id',
        'aktivitas',
        'keterangan'
    ];
    public function credentials(){
        return $this->belongsTo(UserCredentials::class, 'user_credentials_id', 'id');
    }
}
