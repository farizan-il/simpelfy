<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqKategori extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'faqkategori';
    protected $primaryKey = 'id';
    protected $fillable = [
        'namaKategori'
    ];
}
