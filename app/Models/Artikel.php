<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'Artikel';
    protected $primaryKey = 'id';
    protected $fillable = [
        'foto',
        'title',
        'penulis',
        'durasi',
        'content',
        'Disukai'
    ];

    public function artikelRead(){
        return $this->hasOne(ArtikelHasBeenRead::class, 'artikel_id');
    }
}
