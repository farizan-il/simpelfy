<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasProgress extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'UserHasProgress';
    protected $primaryKey = 'id';
    protected $fillable = [
        'modul_detail_id',
        'tests_id',
        'user_credentials_id',
        'orders_id',
        'status',
        'time_spent'
    ];

    public function detailmodul(){
        return $this->belongsTo(detailmodul::class, 'modul_detail_id', 'id');
    }

    public function tests(){
        return $this->belongsTo(Tests::class, 'tests_id', 'id');
    }

    public function credentials(){
        return $this->belongsTo(UserCredentials::class, 'user_credentials_id', 'id');
    }

    public function orders(){
        return $this->belongsTo(Orders::class, 'orders_id', 'id');
    }
    public function spentTime()
    {
        return $this->hasMany(UserHasSpentTime::class, 'user_has_progress_id', 'id');
    }
}

