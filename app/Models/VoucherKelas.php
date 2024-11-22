<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherKelas extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'VoucherKelas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kodeVoucher',
        'jumlahVoucher',
        'potonganHarga',
        'masaAktif'
    ];
}