<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtikelHasBeenRead extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'artikelhasbeenread';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_credentials_id',
        'artikel_id',
        'rating'
    ];

    public function artikelRead(){
        return $this->belongsTo(Artikel::class, 'artikel_id', 'id');
    }
}
