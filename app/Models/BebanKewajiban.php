<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BebanKewajiban extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'jenis_beban_kewajiban_id',
        'nama',
        'nominal',
        'tanggal',
    ];

    public $timestamps = false;
    public function jenis_beban_kewajiban()
    {
        return $this->belongsTo(JenisBebanKewajiban::class, 'jenis_beban_kewajiban_id', 'id');
    }
}
