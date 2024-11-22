<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'SubKategori';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kategori',
        'namaSubkategori'
    ];

    public function kategori(){
        return $this->belongsTo(SubKategori::class, 'id_kategori', 'id');
    }
}
