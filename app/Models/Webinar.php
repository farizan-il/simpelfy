<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'webinar';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'foto', 'title', 'subtitle', 'tanggalMulai', 'jamMulai',
    ];

    public function userHasWebinar(){
        return $this->belongsTo(UserHasWebinar::class, 'user_has_webinar_id');
    }

    public function pendaftar()
    {
        return $this->hasMany(UserHasWebinar::class, 'user_has_webinar_id', 'id');
    }

}