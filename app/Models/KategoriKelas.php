<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKelas extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $fillable = [
        'namaKategori',
        'image'
    ];

    public function kelas(){
        return $this->hasMany(Kelas::class, 'id_kategori');
    }

    public function subkategori(){
        return $this->hasMany(subkategori::class, 'id_kategori');
    }
}