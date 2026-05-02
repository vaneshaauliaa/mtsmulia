<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_pengeluaran extends Model
{
    /** @use HasFactory<\Database\Factories\JenisPengeluaranFactory> */
    use HasFactory;
    protected $table = 'jenis_pengeluaran';
    
    protected $guarded = [];
    protected $fillable = [
        'id_jenis_pengeluaran',
        'nama_jenis_pengeluaran',
        'is_detail_khusus',
    ];

    public function perhitungan_gaji_guru()
{
    return $this->hasMany(Perhitungan_gaji_guru::class);
}
    
}