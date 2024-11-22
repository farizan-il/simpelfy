<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'pelajaran';
    protected $primaryKey = 'id';
    protected $fillable = [
        'bagian_modul_id',
        'file',
        'namaPelajaran',
        'status'
    ];

    public function pelajara(){
        return $this->belongsTo(BagianModul::class, 'bagian_modul_id', 'id');
    }
}
