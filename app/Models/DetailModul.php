<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailModul extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'detail_modul';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_modul',
        'file',
        'detailSubModul',
        'duration'
    ];

    public function modul()
    {
        return $this->belongsTo(ModulKelas::class, 'id_modul', 'id');
    }

    public function userprogress()
    {
        return $this->hasOne(UserHasProgress::class, 'modul_detail_id');
    }
}
