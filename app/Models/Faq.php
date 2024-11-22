<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faq extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'faq';
    protected $primaryKey = 'id';
    protected $fillable =[
        'kategori_id',
        'pertanyaan',
        'jawaban',
        'nilai'
    ];

    public function faqkategori(){
        return $this->belongsTo(FaqKategori::class, 'kategori_id', 'id');
    }
}
