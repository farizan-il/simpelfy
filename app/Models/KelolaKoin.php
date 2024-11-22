<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaKoin extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'kelolakoin';
    protected $primaryKey = 'id';
    protected $fillable = [
        'departement_id',
        'golongan_id',
        'gonpay'
    ];

    public function departement(){
        return $this->belongsTo(Departement::class, 'departement_id','id');
    }
    public function golongan(){
        return $this->belongsTo(Golongan::class, 'golongan_id','id');
    }
}
