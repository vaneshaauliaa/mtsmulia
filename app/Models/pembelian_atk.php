<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelian_atk extends Model
{
    /** @use HasFactory<\Database\Factories\PembelianAtkFactory> */
    use HasFactory;
    protected $table = 'pembelian_atk';

    protected $fillable = [
        'kode_pembelian',
        'tanggal_pembelian',
        'total_harga',
        'bukti_pembelian',
    ];

    protected $casts = [
    'tanggal_pembelian' => 'date',
    ];

    public function detailPembelianAtk()
    {
        return $this->hasMany(detail_pembelian_atk::class, 'pembelian_atk_id');
    }

}