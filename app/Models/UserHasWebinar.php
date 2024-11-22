<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasWebinar extends Model
{
    protected $table = 'UserHasWebinar';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'user_credentials_id', 'user_has_webinar_id',
    ];

    public function webinar(){
        return $this->belongsTo(Webinar::class, 'user_has_webinar_id', 'id');
    }

    public function credentials(){
        return $this->belongsTo(UserCredentials::class, 'user_credentials_id', 'id');
    }
}
