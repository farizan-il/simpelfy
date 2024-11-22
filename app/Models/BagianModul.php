<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagianModul extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'bagian_modul';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_evaluasi_id',
        'judulModul'
    ];

    public function evaluasi(){
        return $this->belongsTo(UserHasEvaluasi::class, 'user_evaluasi_id', 'id');
    }
}
