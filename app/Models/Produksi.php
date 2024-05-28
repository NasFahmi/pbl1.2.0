<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produksi extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'produk',
        'jumlah',
        'volume',
        'tanggal',
    ];
    public $timestamps = false;
}
