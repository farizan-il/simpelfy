<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasSpentTime extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'UserHasSpentTime';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_has_progress_id',
        'spentTime', //format deafultnya menit
        'type' //video dan test
    ];

    public function userProgress(){
        return $this->belongsTo(UserHasProgress::class, 'user_has_progress_id', 'id');
    }
}