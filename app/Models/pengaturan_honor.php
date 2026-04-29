<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengaturan_honor extends Model
{
    /** @use HasFactory<\Database\Factories\PengaturanHonorFactory> */
    use HasFactory;

    protected $table = 'pengaturan_honor';

    protected $fillable = [
        'nama_honor',
        'jumlah_honor',
    ];
}
