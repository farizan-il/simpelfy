<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarReply extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'komentarreply';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_credentials_id',
        'user_komentar_id',
        'komentar_reply'
    ];

    public function credentials(){
        return $this->belongsTo(UserCredentials::class, 'user_credentials_id', 'id');
    }

    public function komentar(){
        return $this->belongsTo(UserKomentar::class, 'user_credentials_id', 'id');
    }
}
