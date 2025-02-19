<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogBerita extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'blogberita';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sampul',
        'title',
        'link'
    ];
}
