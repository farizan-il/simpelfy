<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kategori',
        'title',
        'subtitle',
        'harga',
        'deskripsi',
        'foto',
        'keuntungan',
        'syarat',
        'instruktur',
        'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriKelas::class, 'id_kategori', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'kelas_id');
    }

    public function modul()
    {
        return $this->hasMany(ModulKelas::class, 'id_kelas');
    }

    public function keranjang()
    {
        return $this->hasOne(Keranjang::class, 'kelas_id');
    }
    
    public function kelasWajib()
    {
        return $this->hasMany(KelasWajib::class, 'kelas_id');
    }

    public function preTest()
    {
        return $this->hasOne(Tests::class, 'kelas_id')->where('type', 'pre-test');
    }

    public function postTest()
    {
        return $this->hasOne(Tests::class, 'kelas_id')->where('type', 'post-test');
    }
    public function userkomentar()
    {
        return $this->hasMany(UserKomentar::class, 'kelas_id');
    }
}
