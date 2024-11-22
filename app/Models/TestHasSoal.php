<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestHasSoal extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'TestHasSoal';
    protected $primaryKey = 'id';
    protected $fillable = [
        'test_id',
        'questionText',
        'options',
        'correctAnswer',
        'explantion'
    ];

    public function Test(){
        return $this->belongsTo(Tests::class, 'test_id', 'id');
    }
}
