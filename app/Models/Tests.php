<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'tests';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kelas_id',    // Nullable untuk mid-test
        'modul_id',    // Nullable untuk pre-test dan post-test
        'type',        // 'pre-test', 'mid-test', atau 'post-test'
        'duration'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function modul()
    {
        return $this->belongsTo(ModulKelas::class, 'modul_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(TestHasSoal::class, 'test_id');
    }
}
