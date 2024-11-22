<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_credentials_id',
        'kelas_id',
        'harga',
        'tanggalPembelian',
        'masaAktif',
    ];
    
    protected $casts = [
        'tanggalPembelian' => 'datetime',
    ];

    public function credentials(){
        return $this->belongsTo(UserCredentials::class, 'user_credentials_id', 'id');
    }

    public function kelas(){
        return $this->belongsTo(kelas::class, 'kelas_id', 'id');
    }

    public function userprogress()
    {
        return $this->hasMany(UserHasProgress::class, 'orders_id', 'id');
    }

    public function getSisaWaktuAttribute()
    {
        $masaAktifDate = Carbon::parse($this->masaAktif);
        $remainingDays = Carbon::now()->diffInDays($masaAktifDate, false);

        // Hitung persentase progress
        $totalModul = $this->userprogress->count();
        $completedModul = $this->userprogress->where('status', 'selesai')->count();
        $progress = $totalModul > 0 ? ($completedModul / $totalModul) * 100 : 0;

        if ($progress == 100) {
            return "$remainingDays Hari Lagi";
        } elseif ($remainingDays <= 0 && $progress < 100) {
            return "expired";
        } else {
            return "$remainingDays Hari Lagi";
        }
    }

    // Accessor untuk mendapatkan kelas warna berdasarkan sisa waktu
    public function getSisaWaktuClassAttribute()
    {
        $masaAktifDate = Carbon::parse($this->masaAktif);
        $remainingDays = Carbon::now()->diffInDays($masaAktifDate, false);

        // Tentukan kelas warna berdasarkan sisa waktu
        if ($remainingDays < 1) {
            return 'bg-label-secondary';
        }
        elseif ( $remainingDays < 4) {
            return 'bg-label-danger';
        } elseif ($remainingDays < 8) {
            return 'bg-label-warning';
        } else {
            return 'bg-label-primary';
        }
    }
}