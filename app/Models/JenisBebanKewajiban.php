<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBebanKewajiban extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis_beban_kewajiban',
    ];
    public function beban_kewajiban()
    {
        return $this->hasOne(JenisBebanKewajiban::class);
    }
}
