<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasWajib extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'kelaswajib';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kelas_id',
        'departement_id',
        'golongan_id'
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function departement(){
        return $this->belongsTo(Departement::class, 'departement_id', 'id');
    }

    public function golongan(){
        return $this->belongsTo(Golongan::class, 'golongan_id', 'id');
    }
}
