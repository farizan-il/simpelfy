<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulKelas extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'modul';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kelas',
        'judulModul'
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function detailModul()
    {
        return $this->hasMany(DetailModul::class, 'id_modul');
    }

    public function midTest()
    {
        return $this->hasOne(Tests::class, 'modul_id')->where('type', 'mid-test');
    }
}




